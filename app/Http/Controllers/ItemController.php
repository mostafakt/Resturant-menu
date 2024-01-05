<?php

namespace App\Http\Controllers;

use App\Filters\ItemFilter;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\Item\ItemRequest;
use App\Http\Resources\Item\ItemLight;
use App\Http\Resources\Item\ItemList;
use App\Http\Resources\Item\ItemDetails;
use App\Http\Services\ItemService;
use App\Models\Item;

class ItemController extends BaseController
{
    private ItemService $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;

        $this->middleware('auth:sanctum');
//        $this->authorizeResource(Item::class);
    }

    public function index(ItemFilter $filter)
    {
        $query = $this->itemService->getAll($filter);

        $light = request('light', 0);
        if ($light == 'true' || $light == 1) {
            return ItemLight::query($query);
        }

        return ItemList::query($query);
    }

    public function store(ItemRequest $request): ItemDetails
    {
        $item = $this->itemService->create($request->getData());

        return new ItemDetails($item);
    }

    public function show(mixed $id): ItemDetails
    {
        $item = $this->itemService->find($id);

        return new ItemDetails($item);
    }

    public function update(mixed $id, ItemRequest $request): ItemDetails
    {
        $item = $this->itemService->update($id, $request->getData());

        return new ItemDetails($item);
    }

    public function destroy(mixed $id)
    {
        $this->itemService->delete($id);

        return response()->noContent();
    }
}
