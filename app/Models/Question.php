<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
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

    /**
     * カテゴリID・検索ワードでの検索
     *
     * @param array $attributes
     * @return LengthAwarePaginator
     */
    public function searchByRequests(array $attributes): LengthAwarePaginator
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

    /**
     * 自分の投稿した質問取得
     *
     * @return void
     */
    public function fetchMyQuestions()
    {
        return $this->with(['tagCategory'])
            ->withCount('comments')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(config('const.paginate'));
    }

    /**
     * 質問新規保存
     *
     * @param array $attributes
     * @return void
     */
    public function storeMyQuestion(array $attributes)
    {
        $question = $this->fill($attributes);
        $question->user_id = Auth::id();
        $question->save();
    }

    /**
     * 自分の投稿した質問を更新
     *
     * @param array $attributes
     * @param integer $questionId
     * @return void
     */
    public function editMyQuestion(array $attributes, int $questionId)
    {
        $this->find($questionId)
            ->fill($attributes)
            ->save();
    }

    /**
     * 自分の投稿した質問を論理削除
     *
     * @param integer $questionId
     * @return void
     */
    public function deleteMyQuestion(int $questionId)
    {
        $user = Auth::user();

        $question = $this->find($questionId);

        if ($user->can('delete', $question)) {
            $question->delete();
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tagCategories()
    {
        return $this->belongsToMany(TagCategory::class, 'question_tag_category', 'question_id', 'tag_category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'question_id', 'id');
    }
}
