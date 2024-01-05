<?php

namespace App\Http\Resources\Auth;

use App\Enums\Permission\RoleName;
use App\Http\Resources\Base\BaseJsonResource;
use App\Http\Resources\User\UserClientDetails;
use App\Http\Resources\User\UserDriverDetails;
use App\Http\Resources\User\UserEmployeeDetails;
use App\Http\Resources\User\UserInvsetorDetails;

class LoginResponse extends BaseJsonResource
{
    protected string $roleName;

    public function __construct($resource, $roleName)
    {
        $this->roleName = $roleName;
        parent::__construct($resource);
    }

    protected static function relations(): array
    {
        return [

        ];
    }

    public function toArray($request): array
    {
        return [
            'token' => $this['token'],
            'user' => $this->userDetails()
        ];
    }

    public function userDetails()
    {
        $userDetails = null;
        switch ($this->roleName) {
            case RoleName::CLIENT->value :
                $userDetails = new UserClientDetails($this['user']);
                break;
            case RoleName::Driver->value :
                $userDetails = new UserDriverDetails($this['user']);
                break;
            case RoleName::INVESTOR->value :
                $userDetails = new UserInvsetorDetails($this['user']);
                break;
            case RoleName::ADMIN->value :
                $userDetails = new UserEmployeeDetails($this['user']);
                break;
        }
        return $userDetails;

    }

    public function toResponse($request)
    {
        if ($this['newUser']){
            return parent::toResponse($request)->setStatusCode(201);
        }
        else {
            return parent::toResponse($request)->setStatusCode(200);
        }
    }
}
