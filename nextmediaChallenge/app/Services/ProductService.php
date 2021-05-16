<?php

namespace App\Services;

use App\Category;
use App\Product;

class ProductService
{
    public function getAllProducts() 
    {
        $products = Product::query();
        return $products->get();
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
        $product = Product::where('id', $id);
        if (!$product->exists()) {
            abort(404);
        }
        return $product->get();
    }

    public function create($data) 
    {
        return $product = Product::create($data);
    }

    public function update($id, $data) 
    {
        $product = Product::where('id', $id);

        if (!$product->exists()) {
            abort(404);
        }
        
        return $product->update($data);       
    }

    public function delete($id) 
    {
        $product = Product::where('id', $id);
        if (!$product->exists()) {
            abort(404);
        }
        return $product->delete();
    }

    public function assocProductCategory($id, $categories)
    {
        $product = Product::where('id', $id);
        if (!$product->exists()) {
            abort(404);
        }
        $product = $product->first();
        return $product->categories()->attach($categories);
         
    }

    public function addImageToProduct($id, $image)
    {
        $product = Product::where('id', $id);
        if (!$product->exists()) {
            abort(404);
        }

        $product->update([
            'image' => $image
        ]);
        return $product->first();
    }
}
