<?php

namespace App\Http\Controllers;

use App\Filters\DiscountFilter;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\Discount\DiscountRequest;
use App\Http\Resources\Discount\DiscountLight;
use App\Http\Resources\Discount\DiscountList;
use App\Http\Resources\Discount\DiscountDetails;
use App\Http\Services\DiscountService;
use App\Models\Discount;

class DiscountController extends BaseController
{
    private DiscountService $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;

        $this->middleware('auth:sanctum');
        $this->authorizeResource(Discount::class);
    }

    public function index(DiscountFilter $filter)
    {
        $query = $this->discountService->getAll($filter);

        $light = request('light', 0);
        if ($light == 'true' || $light == 1) {
            return DiscountLight::query($query);
        }

        return DiscountList::query($query);
    }

    public function store(DiscountRequest $request): DiscountDetails
    {
        $discount = $this->discountService->create($request->getData());

        return new DiscountDetails($discount);
    }

    public function show(mixed $id): DiscountDetails
    {
        $discount = $this->discountService->find($id);

        return new DiscountDetails($discount);
    }

    public function update(mixed $id, DiscountRequest $request): DiscountDetails
    {
        $discount = $this->discountService->update($id, $request->getData());

        return new DiscountDetails($discount);
    }

    public function destroy(mixed $id)
    {
        $this->discountService->delete($id);

        return response()->noContent();
    }
}
