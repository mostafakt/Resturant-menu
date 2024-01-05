<?php

namespace App\Http\Controllers;

use App\Exports\EmployeExport;
use App\Filters\EmployeeFilter;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\Employee\EmployeeExportReqyest;
use App\Http\Requests\Employee\EmployeeRequest;
use App\Http\Resources\Employee\EmployeeDetails;
use App\Http\Resources\Employee\EmployeeLight;
use App\Http\Resources\Employee\EmployeeList;
use App\Http\Services\EmployeeService;
use App\Models\Employee;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class EmployeeController extends BaseController
{
    private EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;

        $this->middleware('auth:sanctum');
        //        $this->authorizeResource(Employee::class);
    }

    public function export(EmployeeFilter $filter, EmployeeExportReqyest $request): BinaryFileResponse
    {
        $this->authorize('export',Employee::class);
        $query = $this->employeeService->getAll($filter);

        $query = EmployeeList::queryWithRelations($query);

        return Excel::download(new EmployeExport($query, $request->getData()), 'Employees.xlsx');
    }

    public function index(EmployeeFilter $filter)
    {
        $this->authorize('viewAny',Employee::class);
        $query = $this->employeeService->getAll($filter);

        $light = request('light', 0);
        if ($light == 'true' || $light == 1) {
            return EmployeeLight::query($query);
        }

        return EmployeeList::query($query);
    }

    public function store(EmployeeRequest $request): EmployeeDetails
    {
        $this->authorize('create',Employee::class);
        $employee = $this->employeeService->create($request->getData());

        return new EmployeeDetails($employee);
    }

    public function show(mixed $id): EmployeeDetails
    {
        $employee = $this->employeeService->find($id);
        $this->authorize('view',$employee);

        return new EmployeeDetails($employee);
    }

    public function update(mixed $id, EmployeeRequest $request): EmployeeDetails
    {
        $employee = $this->employeeService->find($id);
        $this->authorize('update',$employee);
        $employee = $this->employeeService->update($id, $request->getData());

        return new EmployeeDetails($employee);
    }

    public function destroy(mixed $id)
    {
        $employee = $this->employeeService->find($id);
        $this->authorize('delete',$employee);
        $this->employeeService->delete($id);

        return response()->noContent();
    }
}
