<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getAllCategories()
    {
        $data = $this->categoryService->getAllCategories();
        return new CategoryCollection($data);
    }

    public function createCategory($data)
    {
        return $this->categoryService->create($data);
    }

    public function deleteCategory($id)
    {
        return $this->categoryService->delete($id);
    }
    
}
