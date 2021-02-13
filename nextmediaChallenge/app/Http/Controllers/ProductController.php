<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function createProduct($data) 
    {
        $this->productService->create($data);
    }
    public function deleteProduct($id) 
    {
        $this->productService->delete($id);
    }

    public function index()
    {
        
    }

    public function store() 
    {
        $data = request()->validate([
            'name' => 'required',
            'descriptio' => 'required',
            'price' => 'required',
        ]);
    }

}
