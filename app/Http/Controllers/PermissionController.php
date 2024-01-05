<?php

namespace App\Http\Controllers;

use App\Filters\PermissionFilter;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\Permission\PermissionRequest;
use App\Http\Resources\Permission\PermissionDetails;
use App\Http\Resources\Permission\PermissionLight;
use App\Http\Resources\Permission\PermissionList;
use App\Http\Services\PermissionService;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController
{
    private PermissionService $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;

        $this->middleware('auth:sanctum');
//        $this->authorizeResource(Permission::class);
    }

    public function index(PermissionFilter $filter)
    {
        $this->authorize('viewAny',Permission::class);
        $query = $this->permissionService->getAll($filter);

        $light = request('light', 0);
        if ($light == 'true' || $light == 1) {
            return PermissionLight::query($query);
        }

        return PermissionList::query($query);
    }
}
