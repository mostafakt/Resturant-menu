<?php

namespace App\Http\Services;

use App\Enums\Auth\personalAccessTokenType;
use App\Enums\Permission\RoleName;
use App\Enums\User\UserStatus;
use App\Http\Services\Base\BaseService;
use App\Models\Client;
use App\Models\CollectionPoint;
use App\Models\Otp;
use App\Models\User;
use App\Notifications\Auth\SendOtp;
use App\Notifications\VerificationCode;
use Illuminate\Support\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

class AuthService extends BaseService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getMe(): array
    {
        $user = Auth::user();
        abort_if(!$user, 401, __('exceptions.unauthorized'));
        $collectionPoint = CollectionPoint::where("employ_id", $user->id)->first();
       
        return [
            'user' => $user,
            'collectionPoint' => $collectionPoint
        ];
    }

    public function clientGetMe()
    {
        $client =  Auth::user()->client;
        abort_if(!$client, 401, __('exceptions.unauthorized'));
        return $client;
    }

    public function investorGetMe()
    {
        $investor =  Auth::user()->investor;
        abort_if(!$investor, 401, __('exceptions.unauthorized'));
        return $investor;
    }

    public function driverGetMe()
    {
        $driver =  Auth::user()->driver;
        abort_if(!$driver, 401, __('exceptions.unauthorized'));
        return $driver;
    }

    public function updateMe(array $data): User
    {
        return $this->userService->update(Auth::id(), $data);
    }


    public function driverUpdateMe(array $data)
    {
        /** @var User $user */
        $user = Auth::user();
        $driver = $user->driver;

        $user->update($data);
        $driver?->update($data);
        abort_if(!$driver, 401, __('exceptions.unauthorized'));
        return $driver->refresh();
    }

    public function clientUpdateMe(array $data)
    {
        if (isset($data['mobile'])) {
            $mobile = $data['mobile'];

            $data = array_filter($data, function ($key) {
                return $key !== "mobile";
            }, ARRAY_FILTER_USE_KEY);

            // Store in cache with a specified key and a time-to-live (TTL)
            cache()->put('user_mobile_' . auth()->id(), $mobile, 60);

            $this->sendOtp($mobile);
        }

        /** @var User $user */
        $user = Auth::user();
        /** @var Client $client */
        $client = $user->client;

        $user->update($data);


        $client?->update($data);

        abort_if(!$client, 401, __('exceptions.unauthorized'));

        return $client->refresh();
    }

    public function investorUpdateMe(array $data)
    {
        /** @var User $user */
        $user = Auth::user();
        $investor = $user->investor;

        $user->update($data);

        $investor?->update($data);

        abort_if(!$investor, 401, __('exceptions.unauthorized'));

        return $investor->refresh();
    }

    public function verifyMobile(string $code)
    {
        db::transaction(function () use ($code) {
            // Retrieve the mobile number from the cache
            $mobileNumber = cache()->get('user_mobile_' . auth()->id());

            if ($mobileNumber !== null) {
                // Mobile number found in cache
                $otpData = Otp::where('mobile', $mobileNumber)
                    ->where('otp', $code)
                    ->where('is_verified', false)
                    ->where('expires_at', '>', Carbon::now()) // Check if OTP has not expired
                    ->first();

                abort_if(!$otpData, 400, __('Invalid OTP or OTP expired'));
                $otpData->is_verified = true;
                $otpData->save();

                /** @var User $user */
                $user = Auth::user();
                $user->update([
                    'mobile' => $mobileNumber,
                ]);
            } else {
                // Mobile number not found in cache
                abort(400, __('mobile not found'));
            }
        });
    }

    public function changeLanguage($data)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->currentAccessToken()->changeLanguage($data['language']);
    }

    public function changeFCMToken($data)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->currentAccessToken()->changeFCMToken($data['token'] ?? null);
    }

    public function register(array $data): User
    {
        return db::transaction(function () use ($data) {

            $data['status'] = UserStatus::ACTIVE;

            /** @var User $user */
            $user = $this->userService->create($data);
            $user->client()->create();
            $user->assignRole(RoleName::CLIENT->value);
            $this->sendOtp($data['mobile']);
            return $user;
        });
    }

    public function login(array $data): array
    {
        return DB::transaction(function () use ($data) {
            /** @var User $user */
            $user = User::query()
                ->where('users.email', $data['email'])
                ->firstOr(function () {
                    abort(400, __('Invalid credentials'));
                });

            if (!Hash::check($data['password'], $user->getAuthPassword())) {
                abort(400, __('Invalid credentials'));
            }

            $token = null;

            if ($user->status->value == UserStatus::ACTIVE->value) {
                $token = $user->createToken('authToken', personalAccessTokenType::employee->value)->plainTextToken;
            }
            if ($user->status->value === UserStatus::INACTIVE->value) {
                abort(403, __('exceptions.auth.banned'));
            }

            return [
                'token' => $token,
                'user' => $user,
                'newUser' => false
            ];
        });
    }

    public function logout(array $data)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($data['logoutFromAllDevices'] ?? false) {
            $user->tokens()->delete();
        } else {
            $user->currentAccessToken()->delete();
        }
    }

    public function verify($data): array
    {
        return DB::transaction((function () use ($data) {

            /** @var User $user */
            $user = User::query()
                ->where('users.email', $data['email'])
                ->whereNotNull('users.verification_code')
                ->where('users.status', UserStatus::NotVerified->value)
                ->firstOr(function () {
                    abort(400, __('Invalid code'));
                });

            if (!Hash::check($data['code'], $user->verification_code)) {
                abort(400, __('Invalid code'));
            }

            $user->update([
                'verification_code' => null,
                'status' => UserStatus::Verified->value
            ]);

            $token = $user->createToken('authToken')->plainTextToken;

            return [
                'token' => $token,
                'user' => $user
            ];
        }));
    }

    public function resendVerificationCode($data)
    {
        /** @var User $user */
        $user = User::query()
            ->where('users.email', $data['email'])
            ->where('users.status', UserStatus::NotVerified->value)
            ->firstOr(function () {
                abort(400, __('Invalid email'));
            });

        $code = $this->generateCode();

        $user->update([
            'verification_code' => Hash::make($code)
        ]);

        $user->notify(new VerificationCode($code));
    }

    public function changePassword($data)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($data['oldPassword'], $user->getAuthPassword())) {
            abort(400, __('Invalid password'));
        }

        $user->update([
            'password' => $data['password']
        ]);
    }

    public function forgetPassword($data)
    {
        DB::transaction(function () use ($data) {
            $broker = Password::broker();

            $res = $broker->sendResetLink($data, function (User $user, $code) {
                $user->sendPasswordResetNotification($code);
            });

            switch ($res) {
                case Password::INVALID_USER:
                    abort(400, __('We can\'t find a user with that email address'));
                case  Password::INVALID_TOKEN:
                    abort(400, __('This password reset token is invalid'));
                case  Password::RESET_THROTTLED:
                    abort(400, __('Please wait before retrying'));
            }
        });
    }

    public function resetPassword($data)
    {
        DB::transaction(function () use ($data) {

            $broker = Password::broker();

            $res = $broker->reset($data, function ($user, $password) {
                $user->update([
                    'password' => $password
                ]);
            });

            switch ($res) {
                case Password::INVALID_USER:
                    abort(400, __('We can\'t find a user with that email address'));
                case  Password::INVALID_TOKEN:
                    abort(400, __('This password reset token is invalid'));
                case  Password::RESET_THROTTLED:
                    abort(400, __('Please wait before retrying'));
            }
        });
    }

    private function generateCode(): string
    {
        $code = random_int(10000, 99999);
        if (env('APP_DEBUG')) {
            $code = 12345;
        }

        return $code;
    }

    public function clientLogin($data)
    {
        return db::transaction(function () use ($data) {
            $otpData = Otp::where('mobile', $data['mobile'])
                ->where('otp', $data['code'])
                ->where('is_verified', false)
                ->where('expires_at', '>', Carbon::now()) // Check if OTP has not expired
                ->first();

            abort_if(!$otpData, 400, __('Invalid OTP or OTP expired'));
            $otpData->is_verified = true;
            $otpData->save();

            $newUser = false;
            /** @var User $user */
            $user = User::where('users.mobile', $data['mobile'])->firstor(function () use ($data, &$newUser) {
                $newUser = true;
                $data['status'] = UserStatus::ACTIVE->value;

                /** @var User $user */
                $user = $this->userService->create($data);
                $user->client()->create();
                $user->assignRole(RoleName::CLIENT->value);
                return $user;
            });

            //investor or driver create account in client app
            if (!$user->hasRole(RoleName::CLIENT->value)) {
                $newUser = true;
                $user->client()->create();
                $user->assignRole(RoleName::CLIENT->value);
            }

            if ($user->status->value === UserStatus::ACTIVE->value) {
                $token = $user->createToken('authToken', personalAccessTokenType::client->value)->plainTextToken;
            }
            if ($user->status->value === UserStatus::INACTIVE->value) {
                abort(403, __('exceptions.auth.banned'));
            }

            $client = $user->client;
            abort_if(!$client, 401, __('exceptions.unauthorized'));

            return [
                'token' => $token ?? null,
                'client' => $client,
                'newUser' => $newUser
            ];
        });
    }

    public function investorLogin($data)
    {
        return db::transaction(function () use ($data) {
            $otpData = Otp::where('mobile', $data['mobile'])
                ->where('otp', $data['code'])
                ->where('is_verified', false)
                ->where('expires_at', '>', Carbon::now()) // Check if OTP has not expired
                ->first();
            abort_if(!$otpData, 400, __('Invalid OTP or OTP expired'));
            $otpData->is_verified = true;
            $otpData->save();

            /** @var User $user */
            $user = User::where('mobile', $data['mobile'])->firstor(function () {
                abort(400, __('Invalid credentials'));
            });

            if ($user->status->value === UserStatus::ACTIVE->value) {
                $token = $user->createToken('authToken', personalAccessTokenType::investor->value)->plainTextToken;
            }
            if ($user->status->value === UserStatus::INACTIVE->value) {
                abort(403, __('exceptions.auth.banned'));
            }

            if (!$user->hasRole(RoleName::INVESTOR->value)) {
                abort(403, __('exceptions.auth.banned'));
            }

            $investor = $user->investor;
            abort_if(!$investor, 401, __('exceptions.unauthorized'));

            return [
                'token' => $token ?? null,
                'investor' => $investor,
            ];
        });
    }

    public function driverLogin($data)
    {
        return db::transaction(function () use ($data) {
            $otpData = Otp::where('mobile', $data['mobile'])
                ->where('otp', $data['code'])
                ->where('is_verified', false)
                ->where('expires_at', '>', Carbon::now()) // Check if OTP has not expired
                ->first();

            abort_if(!$otpData, 400, __('Invalid OTP or OTP expired'));
            $otpData->is_verified = true;
            $otpData->save();

            /** @var User $user */
            $user = User::where('users.mobile', $data['mobile'])->firstor(function () use ($data) {
                abort(400, __('Invalid credentials'));
            });

            if ($user->status->value === UserStatus::ACTIVE->value) {
                $token = $user->createToken('authToken', personalAccessTokenType::driver->value)->plainTextToken;
            }
            if ($user->status->value === UserStatus::INACTIVE->value) {
                abort(403, __('exceptions.auth.banned'));
            }

            if (!$user->hasRole(RoleName::Driver->value)) {
                abort(403, __('exceptions.auth.banned'));
            }

            $driver = $user->driver;
            abort_if(!$driver, 401, __('exceptions.unauthorized'));

            return [
                'token' => $token ?? null,
                'driver' => $driver,
            ];
        });
    }

    public function sendOtp(string $mobile)
    {
        $otp = $this->generateCode();
        $otpData = Otp::updateOrCreate(['mobile' => $mobile], [
            'otp' => $otp,
            'is_verified' => false,
            'expires_at' => Carbon::now()->addMinutes(5) // Set OTP expiry time to 5 minutes from now
        ]);
        Notification::send(null, new SendOtp('963' . $mobile, $otp));
    }
}
