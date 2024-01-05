<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserDetails;
use App\Http\Resources\User\UserLight;
use App\Http\Resources\User\UserList;
use App\Http\Services\UserService;
use App\Models\User;

class UserController extends BaseController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        $this->middleware('auth:sanctum');
        $this->authorizeResource(User::class);
    }

    public function index(UserFilter $filter)
    {
        $query = $this->userService->getAll($filter);

        if ($this->lightList()) {
            return UserLight::query($query);
        }

        return UserList::query($query);
    }

    public function store(UserRequest $request): UserDetails
    {
        $user = $this->userService->create($request->getData());

        return new UserDetails($user);
    }

    public function show(mixed $id): UserDetails
    {
        $user = $this->userService->find($id);

        return new UserDetails($user);
    }

    public function update(mixed $id, UserRequest $request): UserDetails
    {
        $user = $this->userService->update($id, $request->getData());

        return new UserDetails($user);
    }

    public function destroy(mixed $id)
    {
        $this->userService->delete($id);

        return response()->noContent();
    }
}
