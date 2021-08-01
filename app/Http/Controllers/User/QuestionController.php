<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CommentRequest;
use App\Http\Requests\User\QuestionsRequest;
use App\Models\Comment;
use App\Models\Question;
use App\Models\TagCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    /**
     * 一覧画面表示・検索
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $questions = $this->question
            ->searchByRequests($request->all());

        $tagCategories = $this->tagCategory
            ->pluck('name', 'id');

        return view('user.question.index', compact('questions', 'tagCategories'));
    }

    /**
     * マイページ表示
     *
     * @return View
     */
    public function showMyPage(): View
    {
        $myQuestions = $this->question
            ->fetchMyQuestions();

        return view('user.question.mypage', compact('myQuestions'));
    }

    /**
     * 新規作成画面表示
     *
     * @return View
     */
    public function showCreatePage(): View
    {
        $tagCategories = $this->tagCategory->pluck('name', 'id');

        return view('user.question.create', compact('tagCategories'));
    }

    /**
     * 新規保存
     *
     * @param QuestionsRequest $request
     * @return RedirectResponse
     */
    public function store(QuestionsRequest $request): RedirectResponse
    {
        $this->question
            ->storeMyQuestion($request->all());

        return redirect()->route('question.index');
    }

    /**
     * 削除
     *
     * @param integer $questionId
     * @return RedirectResponse
     */
    public function delete(int $questionId): RedirectResponse
    {
        $this->question
            ->deleteMyQuestion($questionId);

        return redirect()->route('question.show.mypage');
    }

    /**
     * 詳細画面表示
     *
     * @param integer $questionId
     * @return View
     */
    public function showDetailPage(int $questionId): View
    {
        $question = $this->question
            ->find($questionId);

        return view('user.question.show', compact('question'));
    }

    /**
     * コメント処理
     *
     * @param CommentRequest $request
     * @return RedirectResponse
     */
    public function comment(CommentRequest $request): RedirectResponse
    {
        $this->comment
            ->postComment($request->all());

        return redirect()->route('question.show.detail', $request->input('question_id'));
    }

    public function showEditPage(int $questionId): View
    {
        $tagCategories = $this->tagCategory
            ->pluck('name', 'id');

        $myQuestion = $this->question
            ->find($questionId);

        return view('user.question.edit', compact('tagCategories', 'myQuestion'));
    }

    /**
     * 編集確認画面表示
     *
     * @param QuestionsRequest $request
     * @param integer $questionId
     * @return View
     */
    public function showEditConfirmPage(QuestionsRequest $request, int $questionId): View
    {
        $question = $this->question
            ->fill($request->all());

        $question->tag_category_name = $this->tagCategory
            ->getTagCategoryName($request->input('tag_category_id'));

        $question->question_id = $questionId;

        return view('user.question.edit_confirm', compact('question'));
    }

    /**
     * 更新
     *
     * @param QuestionsRequest $request
     * @param integer $questionId
     * @return RedirectResponse
     */
    public function edit(QuestionsRequest $request, int $questionId): RedirectResponse
    {
        $this->question
            ->editMyQuestion($request->all(), $questionId);

        return redirect()->route('question.show.mypage');
    }

    /**
     * 新規作成確認画面表示
     *
     * @param QuestionsRequest $request
     * @return View
     */
    public function showCreateConfirmPage(QuestionsRequest $request): View
    {
        $question = $this->question
            ->fill($request->all());

        $question->tag_category_name = $this->tagCategory
            ->getTagCategoryName($request->input('tag_category_id'));

        return view('user.question.create_confirm', compact('question'));
    }
}
