<?php

namespace App\Services;

use App\Category;

class CategoryService
{
    public function getAllCategories() 
    {
        return Category::all();
    }

    public function getCategory($id) 
    {
        $category = Category::findOrFail($id);
        return $category;
    }

    public function create($data) 
    {
        $category = new Category();
        $category->name = $data['name'];
        $category->save();
    }

    public function update($id, $data) 
    {
        $category = Category::findOrFail($id);
        if ($data['name']) {
            $category->name = $data['name'];
        }
        $category->save();       
    }

    public function delete($id = null, $data = null) 
    {
        $product = Category::findOrFail($id);
        $product->delete();
    }
}
