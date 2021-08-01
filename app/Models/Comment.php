<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'question_id',
    ];

    /**
     * コメント投稿
     *
     * @param array $attributes
     * @return void
     */
    public function postComment(array $attributes): void
    {
        $comment = $this->fill($attributes);
        $comment->content = $attributes['comment'];
        $comment->user_id = Auth::id();
        $comment->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
