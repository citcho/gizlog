<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.question.index');
    }

}
