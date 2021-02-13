<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function parent() {
        return $this->hasOne(Category::class, 'parent_id');
    }
}
