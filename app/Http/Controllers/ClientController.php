<?php

namespace App\Http\Controllers;

use App\Exports\ClientExport;
use App\Filters\ClientFilter;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\Client\ClientExportRequest;
use App\Http\Requests\Client\ClientEditProfileRequest;
use App\Http\Requests\Client\ClientRequest;
use App\Http\Resources\Client\ClientDetails;
use App\Http\Resources\Client\ClientLight;
use App\Http\Resources\Client\ClientList;
use App\Http\Resources\Client\HealthProfileDetails;
use App\Http\Services\ClientService;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ClientController extends BaseController
{
    private ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;

        $this->middleware('auth:sanctum');
        //        $this->authorizeResource(Client::class);
    }

    public function export(ClientFilter $filter, ClientExportRequest $request): BinaryFileResponse
    {
        $this->authorize('export',Client::class);
        $query = $this->clientService->getAll($filter);

        $query = ClientList::queryWithRelations($query);

        return Excel::download(new ClientExport($query, $request->getData()), 'Clients.xlsx');
    }

    public function index(ClientFilter $filter)
    {
        $this->authorize('viewAny',Client::class);
        $query = $this->clientService->getAll($filter);

        $light = request('light', 0);
        if ($light == 'true' || $light == 1) {
            return ClientLight::query($query);
        }

        return ClientList::query($query);
    }


    public function show(mixed $id): ClientDetails
    {
        $client = $this->clientService->find($id);
        $this->authorize('view',$client);

        return new ClientDetails($client);
    }

    public function update(mixed $id, ClientRequest $request): ClientDetails
    {
        $client = $this->clientService->find($id);
        $this->authorize('update',$client);
        $client = $this->clientService->update($id, $request->getData());

        return new ClientDetails($client);
    }

    public function destroy(mixed $id)
    {
        $client = $this->clientService->find($id);
        $this->authorize('delete',$client);
        $this->clientService->delete($id);

        return response()->noContent();
    }


    public function clientEditProfile(ClientEditProfileRequest $request): HealthProfileDetails
    {
        $client = $this->clientService->updateProfile($request->getData(),Auth::id());

        return new HealthProfileDetails($client);
    }

    public function profile(): HealthProfileDetails
    {
        $client = $this->clientService->find(Auth::id());

        return new HealthProfileDetails($client);
    }
}
