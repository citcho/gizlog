<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\TagCategory;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $question;
    private $tagCategory;

    public function __construct(Question $question, TagCategory $tagCategory)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->tagCategory = $tagCategory;
    }

    public function index(Request $request)
    {
        $inputs = $request->all();
        $questions = $this->question
            ->with(['user', 'tagCategory'])
            ->withCount('comments')
            ->when(isset($inputs['tag_category_id']), function ($query) use ($inputs) {
                    $query->where('tag_category_id', $inputs['tag_category_id']);
            })
            ->paginate(10);
        $tagCategories = $this->tagCategory->all();
        return view('user.question.index', compact('questions', 'tagCategories'));
    }
}
