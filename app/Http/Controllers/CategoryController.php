<?php

namespace App\Http\Controllers;

use App\Filters\CategoryFilter;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\Category\CategoryExportRequest;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryDetails;
use App\Http\Resources\Category\CategoryLight;
use App\Http\Resources\Category\CategoryList;
use App\Http\Services\CategoryService;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CategoryController extends BaseController
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

        $this->middleware('auth:sanctum');
        //        $this->authorizeResource(Category::class);
    }


    public function index(CategoryFilter $filter)
    {
        $this->authorize('viewAny', Category::class);
        $query = $this->categoryService->getAll($filter);
        $light = request('light', 0);
        if ($light == 'true' || $light == 1) {
            return CategoryLight::query($query);
        }

        return CategoryList::query($query);
    }

    public function store(CategoryRequest $request): CategoryDetails
    {
        $this->authorize('create', Category::class);
        $category = $this->categoryService->create($request->getData());

        return new CategoryDetails($category);
    }

    public function show(mixed $id): CategoryDetails
    {
        $category = $this->categoryService->find($id);
        $this->authorize('view', $category);

        return new CategoryDetails($category);
    }

    public function update(mixed $id, CategoryRequest $request): CategoryDetails
    {
        $category = $this->categoryService->find($id);
        $this->authorize('update', $category);
        $category = $this->categoryService->update($id, $request->getData());

        return new CategoryDetails($category);
    }

    public function destroy(mixed $id)
    {
        $category = $this->categoryService->find($id);
        $this->authorize('delete', $category);
        $this->categoryService->delete($id);

        return response()->noContent();
    }
}
