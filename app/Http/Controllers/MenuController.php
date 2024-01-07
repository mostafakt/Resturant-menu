<?php

namespace App\Http\Controllers;

use App\Filters\MenuFilter;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\Menu\MenuRequest;
use App\Http\Resources\Menu\MenuLight;
use App\Http\Resources\Menu\MenuList;
use App\Http\Resources\Menu\MenuDetails;
use App\Http\Services\MenuService;
use App\Models\Menu;

class MenuController extends BaseController
{
    private MenuService $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;

        $this->middleware('auth:sanctum');
        $this->authorizeResource(Menu::class);
    }

    public function index(MenuFilter $filter)
    {
        $query = $this->menuService->getAll($filter);

        $light = request('light', 0);
        if ($light == 'true' || $light == 1) {
            return MenuLight::query($query);
        }

        return MenuList::query($query);
    }

    public function store(MenuRequest $request): MenuDetails
    {
        $menu = $this->menuService->create($request->getData());

        return new MenuDetails($menu);
    }

    public function show(mixed $id): MenuDetails
    {
        $menu = $this->menuService->find($id);

        return new MenuDetails($menu);
    }

    public function update(mixed $id, MenuRequest $request): MenuDetails
    {
        $menu = $this->menuService->update($id, $request->getData());

        return new MenuDetails($menu);
    }

    public function destroy(mixed $id)
    {
        $this->menuService->delete($id);

        return response()->noContent();
    }
}
