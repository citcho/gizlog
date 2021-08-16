<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookRequest;
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
        $books = $this->book->fetchAllRecords();
        return view('admin.book.index', compact('books'));
    }

    public function importCsv(BookRequest $request)
    {
        $result = $this->book->bulkInsert($request->file('file')->path());

        if ($result['passed']) {
            return redirect()->route('admin.book.index')->with('flash_message', $result['passed_count'] . '件登録しました。');
        } else {
            return redirect()->route('admin.book.index')->with('flash_message', '登録に失敗しました。<br>CSVファイルに不備があります。');
        }
    }
}
