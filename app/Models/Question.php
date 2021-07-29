<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $dates = [
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tagCategory()
    {
        return $this->belongsTo(TagCategory::class, 'tag_category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'question_id', 'id');
    }
}
