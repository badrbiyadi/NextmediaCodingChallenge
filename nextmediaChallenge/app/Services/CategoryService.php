<?php

namespace App\Services;

use App\Category;

class CategoryService
{
    public function getAllCategories() 
    {
        $categories = Category::query();

        return $categories->get();
    }

    public function getCategory($id) 
    {
        $category = Category::where('id', $id);
        return $category->get();
    }

    public function create($data) 
    {
        return Category::create($data);
    }

    public function update($id, $data) 
    {
        $category = Category::where('id', $id);    
        if(!$category->exists()) {
            abort(404);
        }
        return $category->update($data);
    }

    public function delete($id) 
    {
        $category = Category::where('id', $id);
        if($category->exists()) {
            abort(404);
        }
        return $category->delete();
    }
    
    public function checkIfCategoryExists($id) {
        return Category::where('id', $id)->exists();
    }
}
