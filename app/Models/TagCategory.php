<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TagCategory extends Model
{
    protected $table = 'tag_categories';

    /**
     * 複数カテゴリIDでのカテゴリ検索
     *
     * @param array $tagCategoryIdList
     * @return Illuminate\Database\Eloquent\Collection;
     */
    public function fetchTagCategories(array $tagCategoryIdList): Collection
    {
        return $this->whereIn('id', $tagCategoryIdList)->get();
    }
}
