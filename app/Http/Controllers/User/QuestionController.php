<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Question;

class QuestionController extends Controller
{
    private $question;

    public function __construct(Question $question)
    {
        $this->middleware('auth');
        $this->question = $question;
    }

    public function index()
    {
        $questions = $this->question->with(['user', 'tagCategory'])->withCount('comments')->paginate(10);
        return view('user.question.index', compact('questions'));
    }
}
