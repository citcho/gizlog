<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'questions';

    protected $fillable = [
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
        return $this->with(['user', 'tagCategories'])
            ->withCount('comments')
            ->when(isset($attributes['tag_category_id']), function ($query) use ($attributes) {
                // $query->whereHas('tagCategories', function ($query) use ($attributes) {
                //     dd($query->where('id', '=', $attributes['tag_category_id'])->get());
                //     dd($query);
                //     $query->where('tag_categories.id', [$attributes['tag_category_id']]);
                // });
                $query->join('question_tag_category', 'questions.id', '=', 'question_tag_category.question_id')
                    ->where('question_tag_category.tag_category_id', $attributes['tag_category_id']);
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
        return $this->with(['tagCategories'])
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
        DB::transaction(function () use ($attributes) {
            $question = $this->fill($attributes);
            $question->user_id = Auth::id();
            $question->save();

            $question->tagCategories()
                ->attach($attributes['tag_category_id']);
        });
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
        $question = $this->find($questionId);

        DB::transaction(function () use ($attributes, $question) {
            $question->fill($attributes)
                ->save();

            $question->tagCategories()
                ->sync($attributes['tag_category_id']);
        });
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
