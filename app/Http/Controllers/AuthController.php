<?php

namespace App\Http\Controllers;

use App\Enums\Permission\RoleName;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\Auth\ChangeFCMTokenRequest;
use App\Http\Requests\Auth\ChangeLanguageRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ClientMeRequest;
use App\Http\Requests\Auth\DriverMeRequest;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Http\Requests\Auth\InvestorMeRequest;
use App\Http\Requests\Auth\LoginFromApp;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\MeRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResendVerificationCodeRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendOtpRequest;
use App\Http\Requests\Auth\verifyMobileRequest;
use App\Http\Requests\Auth\VerifyRequest;
use App\Http\Resources\Auth\ClientLoginResponse;
use App\Http\Resources\Auth\DriverLoginResponse;
use App\Http\Resources\Auth\GetMeResource;
use App\Http\Resources\Auth\InvestorLoginResponse;
use App\Http\Resources\Auth\LoginResponse;
use App\Http\Resources\Client\ClientMeDetails;
use App\Http\Resources\Driver\DriverMeDetails;
use App\Http\Resources\Investor\InvestorMeDetails;
use App\Http\Resources\User\UserClientDetails;
use App\Http\Resources\User\UserDetails;
use App\Http\Services\AuthService;
use Illuminate\Http\Response;

class AuthController extends BaseController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;

        $this->middleware('auth:sanctum')
            ->only([
                'getMe',
                'updateMe',
                'changeLanguage',
                'changeFCMToken',
                'logout',
                'changePassword',
                'clientGetMe',
                'clientUpdateMe',

                'investorGetMe',
                'investorUpdateMe',

                'driverGetMe',
                'driverUpdateMe',
                'verifyMobile',
            ]);
    }

    public function getMe(): GetMeResource
    {
        $user = $this->authService->getMe();

        return new GetMeResource($user, RoleName::ADMIN->value);
    }

    public function clientGetMe(): ClientMeDetails
    {
        $client = $this->authService->clientGetMe();

        return new ClientMeDetails($client);
    }

    public function investorGetMe(): InvestorMeDetails
    {
        $investor = $this->authService->investorGetMe();

        return new InvestorMeDetails($investor);
    }

    public function driverGetMe(): DriverMeDetails
    {
        $client = $this->authService->driverGetMe();

        return new DriverMeDetails($client);
    }

    public function updateMe(MeRequest $request): ClientMeDetails
    {
        $client = $this->authService->updateMe($request->getData());

        return new ClientMeDetails($client);
    }

    public function driverUpdateMe(DriverMeRequest $request): DriverMeDetails
    {
        $user = $this->authService->driverUpdateMe($request->getData());

        return new DriverMeDetails($user);
    }

    public function clientUpdateMe(ClientMeRequest $request): ClientMeDetails
    {
        $user = $this->authService->clientUpdateMe($request->getData());

        return new ClientMeDetails($user);
    }

    public function investorUpdateMe(InvestorMeRequest $request): InvestorMeDetails
    {
        $user = $this->authService->investorUpdateMe($request->getData());

        return new InvestorMeDetails($user);
    }


    public function changeLanguage(ChangeLanguageRequest $request)
    {
        $this->authService->changeLanguage($request->getData());

        return response()->noContent();
    }

    public function changeFCMToken(ChangeFCMTokenRequest $request)
    {
        $this->authService->changeFCMToken($request->getData());

        return response()->noContent();
    }

    public function register(RegisterRequest $request): UserClientDetails
    {
        $user = $this->authService->register($request->getData());

        return new UserClientDetails($user);
    }

    public function login(LoginRequest $request): LoginResponse
    {
        $data = $this->authService->login($request->getData());

        return new LoginResponse($data, RoleName::ADMIN->value);
    }

    public function logout(LogoutRequest $request)
    {
        $this->authService->logout($request->getData());

        return response()->noContent();
    }

    public function verify(VerifyRequest $request): LoginResponse
    {
        $data = $this->authService->verify($request->getData());

        return new LoginResponse($data);
    }

    function resendVerificationCode(ResendVerificationCodeRequest $request)
    {
        $this->authService->resendVerificationCode($request->getData());

        return response()->noContent();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $this->authService->changepassword($request->getData());

        return response()->noContent();
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $this->authService->forgetPassword($request->getData());

        return response()->noContent();
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $this->authService->resetPassword($request->getData());

        return response()->noContent();
    }

    public function clientLogin(LoginFromApp $request): ClientLoginResponse
    {
        $data = $this->authService->clientLogin($request->getData());

        return new ClientLoginResponse($data);
    }

    public function investorLogin(LoginFromApp $request): InvestorLoginResponse
    {
        $data = $this->authService->investorLogin($request->getData());

        return new InvestorLoginResponse($data);
    }

    public function driverLogin(LoginFromApp $request): DriverLoginResponse
    {
        $data = $this->authService->driverLogin($request->getData());

        return new DriverLoginResponse($data);
    }

    public function sendOtp(SendOtpRequest $request): Response
    {
        $this->authService->sendOtp($request->getData()['mobile']);
        return response()->noContent();
    }

    public function verifyMobile(verifyMobileRequest $request)
    {
        $this->authService->verifyMobile($request->getData()['code']);

        return response()->noContent();
    }
}
