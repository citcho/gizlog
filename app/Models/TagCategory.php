<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagCategory extends Model
{
    use SoftDeletes;

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
