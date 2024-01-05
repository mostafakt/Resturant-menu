<?php

namespace App\Http\Controllers;

use App\Exports\RoleExport;
use App\Filters\RoleFilter;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\Role\RoleExportRequest;
use App\Http\Requests\Role\RoleRequest;
use App\Http\Resources\Role\RoleDetails;
use App\Http\Resources\Role\RoleLight;
use App\Http\Resources\Role\RoleList;
use App\Http\Services\RoleService;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RoleController extends BaseController
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;

        $this->middleware('auth:sanctum');
//        $this->authorizeResource(Role::class);
    }

    public function export(RoleFilter $filter, RoleExportRequest $request): BinaryFileResponse
    {
        $this->authorize('export',Role::class);
        $query = $this->roleService->getAll($filter);

        $query = RoleList::queryWithRelations($query);

        return Excel::download(new RoleExport($query, $request->getData()), 'Roles.xlsx');
    }

    public function index(RoleFilter $filter)
    {
        $this->authorize('viewAny',Role::class);
        $query = $this->roleService->getAll($filter);

        $light = request('light', 0);
        if ($light == 'true' || $light == 1) {
            return RoleLight::query($query);
        }

        return RoleList::query($query);
    }

    public function store(RoleRequest $request): RoleDetails
    {
        $this->authorize('create',Role::class);
        $role = $this->roleService->createRole($request->getData());

        return new RoleDetails($role);
    }

    public function show(Role $role): RoleDetails
    {
        $this->authorize('view',$role);
        return new RoleDetails($role);
    }

    public function update(Role $role, RoleRequest $request): RoleDetails
    {
        $this->authorize('update',$role);
        $role = $this->roleService->updateRole($role, $request->getData());

        return new RoleDetails($role);
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete',$role);
        $this->roleService->deleteRole($role);

        return response()->noContent();
    }
}
