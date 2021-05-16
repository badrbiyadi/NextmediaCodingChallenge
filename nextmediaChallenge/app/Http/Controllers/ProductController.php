<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use Intervention\Image\Facades\Image;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAllProducts()
    {
        return new ProductCollection($this->productService->getAllProducts());
    }

    public function store() 
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'image',
            'categories' => '',
        ]);

        $dataToStore = [
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
        ];

        $product = $this->productService->create($dataToStore);

        if(!empty($data['categories'])) {
            $this->productService->assocProductCategory($product->id, $data['categories']);
        }

        if (!empty($data['image'])) {
            $image = $data['image'];
            $ext = $image->getClientOriginalExtension();
            $destination = 'image/product'.$product->id.'.'.$ext;
            Image::make($image)->save(storage_path('app/public/'.$destination));
            $product = $this->productService->addImageToProduct($product->id, '/storage/'.$destination);
        }
        return new ProductResource($product);
    }

}
