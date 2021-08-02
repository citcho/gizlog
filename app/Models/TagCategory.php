<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagCategory extends Model
{
    use SoftDeletes;

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
