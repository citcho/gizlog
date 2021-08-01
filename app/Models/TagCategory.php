<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagCategory extends Model
{
    protected $table = 'tag_categories';

    public function getTagCategoryName($tagCategoryId)
    {
        return $this->find($tagCategoryId)->name;
    }
}
