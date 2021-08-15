<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function index()
    {
        return view('admin.book.index');
    }

    public function importCsv(Request $request)
    {
        $this->book->bulkInsert($request->file('file')->path());
        return redirect()->route('admin.book.index');
    }
}
