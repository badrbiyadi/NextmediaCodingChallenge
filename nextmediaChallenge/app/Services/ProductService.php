<?php

namespace App\Services;

use App\Category;
use App\Product;

class ProductService
{
    public function getAllProducts() 
    {
        return Product::all();
    }

    public function getProducts($filters = [], $sorts = []) 
    {
        if ($filters['categorie']) {
            $products = Category::find($filters['categorie'])->products;
        }else {
            $products = Product::query();  
        }

        if (sizeof($sorts) > 0) {
            foreach($sorts as $sort => $value ) {
                $products->orderBy($sort, $value);
            }
        }

        return $products->get();
    }

    public function getProduct($id) 
    {
        $product = Product::findOrFail($id);
        return $product;
    }

    public function create($data) 
    {
        $product = new Product();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        if (!empty($data['image'])) {
            $product->image = $data['image'];
        }
        $product->save();
    }

    public function update($id, $data) 
    {
        $product = Product::findOrFail($id);
        if ($data['name']) {
            $product->name = $data['name'];
        }
        if ($data['description']) {
            $product->description = $data['description'];
        }
        if ($data['price']) {
            $product->price = $data['price'];
        }
        if ($data['image']) {
            $product->image = $data['image'];
        }
        $product->save();       
    }

    public function delete($id) 
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }
}