<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function createCategory($data)
    {
        $this->categoryService->create($data);
    }

    public function deleteCategory($id)
    {
        $this->categoryService->delete($id);
    }
    
}
