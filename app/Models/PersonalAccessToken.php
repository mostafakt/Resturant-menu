<?php

namespace App\Models;

use App\Enums\Auth\personalAccessTokenType;
use App\Enums\Language\Language;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    protected $fillable = [
        'name',
        'token',
        'abilities',
        'expires_at',
        'fcm_token',
        'language',
        'type'
    ];

    protected $casts = [
        'abilities' => 'json',
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
        'type' => personalAccessTokenType::class,
        'language' => Language::class
    ];

    public function changeLanguage($language)
    {
        $this->forceFill(['language' => $language])
            ->save();
    }

    public function changeFCMToken($token)
    {
        self::query()
            ->where('fcm_token', $token)
            ->update(['fcm_token' => null]);

        $this->forceFill(['fcm_token' => $token])
            ->save();
    }
}
