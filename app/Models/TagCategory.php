<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagCategory extends Model
{
    protected $table = 'tag_categories';

    /**
     * カテゴリIDからカテゴリ名取得
     *
     * @param integer $tagCategoryId
     * @return string
     */
    public function getTagCategoryName(int $tagCategoryId): string
    {
        return $this->find($tagCategoryId)->name;
    }
}
