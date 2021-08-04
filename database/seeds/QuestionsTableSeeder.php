<?php

use App\Models\Comment;
use App\Models\Question;
use App\Models\TagCategory;
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
        DB::table('comments')->truncate();

        $tagCategories = TagCategory::all();

        factory(Question::class, 200)->create()
            ->each(function($question) use ($tagCategories) {
                $question->tagCategories()
                    ->attach($tagCategories->random(rand(1, 4)));

                factory(Comment::class, 200)->create([
                    'question_id' => $question->id,
                ]);
            });
    }
}
