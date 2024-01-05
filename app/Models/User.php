<?php

namespace App\Models;

use App\Enums\Client\Gender;
use App\Enums\Language\Language;
use App\Enums\User\UserStatus;
use App\Models\Base\BaseModel;
use App\Notifications\ResetPassword;
use App\Traits\Notifiable;
use DateTimeInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Spatie\Permission\Traits\HasRoles;

class User extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected array $translatable = [
        'note'
    ];
    protected $fillable = [
        'first_name',
        'last_name',
        'image_id',
        'email',
        'mobile',
        'phone',
        'note',
        'gender',
        'email',
        'password',
        'verification_code',
        'status'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'create_at' => 'datetime',
        'update_at' => 'datetime',
        'deleted_at' => 'datetime',
        'status' => UserStatus::class,
        'gender' => Gender::class
    ];

    /**
     * Create a new personal access token for the user.
     *
     * @param  string  $name
     * @param  array  $abilities
     * @param  \DateTimeInterface|null  $expiresAt
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function createToken(string $name,$type, array $abilities = ['*'], DateTimeInterface $expiresAt = null)
    {

        $plainTextToken = sprintf(
            '%s%s%s',
            config('sanctum.token_prefix', ''),
            $tokenEntropy = Str::random(40),
            hash('crc32b', $tokenEntropy)
        );

        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken),
            'abilities' => $abilities,
            'expires_at' => $expiresAt,
            'type' => $type,
        ]);

        return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
    }

    public function password(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return Hash::make($value);
            },
        );
    }

    /**
     * Interact with the user's mobile.
     */
    protected function mobile(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => '963'.$value,
        );
    }

    public function sendPasswordResetNotification($code)
    {
        $this->notify(new ResetPassword($code));
    }

    public function routeNotificationForMail($notification = null)
    {
        return $this->email;
    }

    public function routeNotificationForFCM($notification = null)
    {
        return $this->tokens()->whereNotNull('fcm_token')->orderBy('created_at','desc');
    }

    public function routeNotificationForSMS($notification = null)
    {
        return $this->mobile;
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    public function driver(): HasOne
    {
        return $this->hasOne(Driver::class);
    }

    public function investor(): HasOne
    {
        return $this->hasOne(Investor::class);
    }

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    public function complaint(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Medium::class, 'image_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->withTrashed();
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by')->withTrashed();
    }

    protected function lastLogin(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->tokens()->max('last_used_at');
            },
        );
    }
}
