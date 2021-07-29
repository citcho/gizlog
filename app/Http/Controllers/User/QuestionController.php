<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CommentRequest;
use App\Http\Requests\User\QuestionsRequest;
use App\Models\Comment;
use App\Models\Question;
use App\Models\TagCategory;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $comment;
    private $question;
    private $tagCategory;

    public function __construct(Comment $comment, Question $question, TagCategory $tagCategory)
    {
        $this->middleware('auth');
        $this->comment = $comment;
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
            ->when(isset($inputs['search_word']), function ($query) use ($inputs) {
                $query->where('title', 'LIKE', '%' . $inputs['search_word'] . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(10);
        $tagCategories = $this->tagCategory->all();
        return view('user.question.index', compact('questions', 'tagCategories'));
    }

    public function showMyPage()
    {
        $myQuestions = $this->question
        ->with(['tagCategory'])
        ->withCount('comments')
        ->where('user_id', \Auth::id())
        ->orderByDesc('created_at')
        ->paginate(10);
        return view('user.question.mypage', compact('myQuestions'));
    }

    public function showCreatePage()
    {
        $tagCategories = $this->tagCategory->pluck('name', 'id');
        return view('user.question.create', compact('tagCategories'));
    }

    public function store(QuestionsRequest $request)
    {
        $question = $this->question->fill($request->all());
        $question->user_id = \Auth::id();
        $question->save();
        return redirect()->route('question.index');
    }

    public function deleteMyQuestion($questionId)
    {
        $question = $this->question->find($questionId);
        if ($question->user_id === \Auth::id()) {
            $question->delete();
        }
        return redirect()->route('question.show.mypage');
    }

    public function showDetailPage($questionId)
    {
        $question = $this->question->find($questionId);
        $comments = $this->comment->with('user')->where('question_id', $questionId)->orderBy('created_at')->get();
        return view('user.question.show', compact('question', 'comments'));
    }

    public function comment(CommentRequest $request)
    {
        $inputs = $request->all();
        $comment = $this->comment->fill($inputs);
        $comment->content = $inputs['comment'];
        $comment->user_id = \Auth::id();
        $comment->save();
        return redirect()->route('question.show.detail', $inputs['question_id']);
    }
}
