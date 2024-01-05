<?php

namespace App\Http\Middleware;

use App\Enums\User\UserStatus;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function authenticate($request, array $guards)
    {
        parent::authenticate($request, $guards);

        if ($this->auth->user()->status === UserStatus::INACTIVE) {
            $this->unauthenticated($request, $guards);
        }
    }
}
