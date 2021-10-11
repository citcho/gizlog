<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

Class RankingService
{
    private const RANKING_PER_PAGE = 20;

    public function updateUserRanking()
    {
        DB::table('user_ranking')->truncate();

        $newUserRanking = DB::table('users')
            ->select('questions.user_id', DB::raw('COUNT(questions.id) as question_count'))
            ->join('questions', 'users.id', '=', 'questions.user_id')
            ->groupBy('user_id')
            ->whereNull('questions.deleted_at')
            ->orderByDesc('question_count')
            ->get()
            ->toArray();

        DB::table('user_ranking')->insert(json_decode(json_encode($newUserRanking), true));
    }

    public function updateCommentRanking()
    {
        DB::table('comment_ranking')->truncate();

        $newCommentRanking = DB::table('users')
            ->select('comments.user_id', DB::raw('COUNT(comments.id) as comment_count'))
            ->join('comments', 'users.id', '=', 'comments.user_id')
            ->groupBy('user_id')
            ->whereNull('comments.deleted_at')
            ->orderByDesc('comment_count')
            ->get()
            ->toArray();

        DB::table('comment_ranking')->insert(json_decode(json_encode($newCommentRanking), true));
    }

    public function updateCategoryRanking()
    {
        DB::table('category_ranking')->truncate();

        $newCommentRanking = DB::table('tag_categories')
            ->select('tag_categories.id as category_id', DB::raw('COUNT(question_tag_category.question_id) as question_count'))
            ->join('question_tag_category', 'tag_categories.id', '=', 'question_tag_category.tag_category_id')
            ->groupBy('category_id')
            ->orderByDesc('question_count')
            ->get()
            ->toArray();

        DB::table('category_ranking')->insert(json_decode(json_encode($newCommentRanking), true));
    }

    public function fetchAllUserRanking()
    {
        return DB::table('user_ranking')
            ->select('user_ranking.question_count', 'users.name', 'users.avatar')
            ->join('users', 'user_ranking.user_id', '=', 'users.id')
            ->orderByDesc('question_count')
            ->paginate(self::RANKING_PER_PAGE);
    }

    public function fetchAllCommentRanking()
    {
        return DB::table('comment_ranking')
            ->select('comment_ranking.comment_count', 'users.name', 'users.avatar')
            ->join('users', 'comment_ranking.user_id', '=', 'users.id')
            ->orderByDesc('comment_count')
            ->paginate(self::RANKING_PER_PAGE);
    }

    public function fetchAllCategoryRanking()
    {
        return DB::table('category_ranking')
            ->select('category_ranking.question_count', 'tag_categories.name')
            ->join('tag_categories', 'category_ranking.category_id', '=', 'tag_categories.id')
            ->orderByDesc('question_count')
            ->paginate(self::RANKING_PER_PAGE);
    }
}