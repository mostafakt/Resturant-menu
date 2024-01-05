<?php

namespace App\Models\Base;

use Illuminate\Auth\Passwords\DatabaseTokenRepository as BaseDatabaseTokenRepository;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class DatabaseTokenRepository extends BaseDatabaseTokenRepository
{
    public function create(CanResetPasswordContract $user)
    {
        $email = $user->getEmailForPasswordReset();

        $this->deleteExisting($user);

        // We will create a new, random token for the user so that we can e-mail them
        // a safe link to the password reset form. Then we will insert a record in
        // the database so that we can verify the token within the actual reset.
        $token = $this->createNewToken();

        $this->getTable()->insert($this->getPayload($email, $token));

        return $token;
    }

    protected function deleteExisting(CanResetPasswordContract $user)
    {
        return $this->getTable()->where('email', $user->getEmailForPasswordReset())->delete();
    }

    public function exists(CanResetPasswordContract $user, $token)
    {
        $record = (array)$this->getTable()->where(
            'email', $user->getEmailForPasswordReset()
        )->first();

        return $record &&
            !$this->tokenExpired($record['created_at']) &&
            $this->hasher->check($token, $record['token']);
    }

    public function recentlyCreatedToken(CanResetPasswordContract $user)
    {
        $record = (array)$this->getTable()->where(
            'email', $user->getEmailForPasswordReset()
        )->first();

        return $record && $this->tokenRecentlyCreated($record['created_at']);
    }

    public function createNewToken()
    {
        $code = random_int(100000, 999999);

        if (env('APP_DEBUG')) {
            $code = 123456;
        }

        return $code;
    }
}
