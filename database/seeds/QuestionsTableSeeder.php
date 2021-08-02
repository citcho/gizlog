<?php

use App\Models\Comment;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();
        factory(Question::class, 200)->create()
            ->each(function($question) {
                factory(Comment::class, 200)->create([
                    'question_id' => $question->id,
                ]);
            });
    }
}
