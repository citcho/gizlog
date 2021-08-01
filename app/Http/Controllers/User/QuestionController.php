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
        $questions = $this->question
            ->searchByRequests($request->all());

        $tagCategories = $this->tagCategory
            ->pluck('name', 'id');

        return view('user.question.index', compact('questions', 'tagCategories'));
    }

    public function showMyPage()
    {
        $myQuestions = $this->question
            ->fetchMyQuestions();

        return view('user.question.mypage', compact('myQuestions'));
    }

    public function showCreatePage()
    {
        $tagCategories = $this->tagCategory->pluck('name', 'id');

        return view('user.question.create', compact('tagCategories'));
    }

    public function store(QuestionsRequest $request)
    {
        $this->question
            ->storeMyQuestion($request->all());

        return redirect()->route('question.index');
    }

    public function delete($questionId)
    {
        $this->question
            ->deleteMyQuestion($questionId);

        return redirect()->route('question.show.mypage');
    }

    public function showDetailPage($questionId)
    {
        $question = $this->question
            ->find($questionId);

        return view('user.question.show', compact('question'));
    }

    public function comment(CommentRequest $request)
    {
        $this->comment
            ->postComment($request->all());

        return redirect()->route('question.show.detail', $request->input('question_id'));
    }

    public function showEditPage($questionId)
    {
        $tagCategories = $this->tagCategory
            ->pluck('name', 'id');

        $myQuestion = $this->question
            ->find($questionId);

        return view('user.question.edit', compact('tagCategories', 'myQuestion'));
    }

    public function showEditConfirmPage(QuestionsRequest $request, $questionId)
    {
        $question = $this->question
            ->fill($request->all());

        $question->tag_category_name = $this->tagCategory
            ->getTagCategoryName($request->input('tag_category_id'));

        $question->question_id = $questionId;

        return view('user.question.edit_confirm', compact('question'));
    }

    public function edit(QuestionsRequest $request, $questionId)
    {
        $this->question
            ->editMyQuestion($request->all(), $questionId);

        return redirect()->route('question.show.mypage');
    }

    public function showCreateConfirmPage(QuestionsRequest $request)
    {
        $question = $this->question
            ->fill($request->all());

        $question->tag_category_name = $this->tagCategory
            ->getTagCategoryName($request->input('tag_category_id'));

        return view('user.question.create_confirm', compact('question'));
    }
}
