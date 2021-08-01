<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'tag_category_id',
        'title',
        'content',
    ];

    protected $dates = [
        'created_at',
    ];

    public function searchByRequests($attributes)
    {
        return $this->with(['user', 'tagCategory'])
            ->withCount('comments')
            ->when(isset($attributes['tag_category_id']), function ($query) use ($attributes) {
                $query->where('tag_category_id', $attributes['tag_category_id']);
            })
            ->when(isset($attributes['search_word']), function ($query) use ($attributes) {
                $query->where('title', 'LIKE', '%' . $attributes['search_word'] . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(config('const.paginate'));
    }

    public function fetchMyQuestions()
    {
        return $this->with(['tagCategory'])
            ->withCount('comments')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(config('const.paginate'));
    }

    public function storeMyQuestion($attributes)
    {
        $question = $this->fill($attributes);
        $question->user_id = Auth::id();
        $question->save();
    }

    public function editMyQuestion($attributes, $questionId)
    {
        $this->find($questionId)
            ->fill($attributes)
            ->save();
    }

    public function deleteMyQuestion($questionId)
    {
        $question = $this->find($questionId);

        if ($question->user_id === Auth::id()) {
            $question->delete();
        }
    }

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
