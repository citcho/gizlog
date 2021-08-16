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
        $originalFileName = $request->file('file')->getClientOriginalName();

        if ($result['passed']) {
            \Log::channel('csv')->info('[CSV取り込み成功]ファイル名：' . $originalFileName . ', 件数：' . $result['passed_count'] . '件');

            return redirect()->route('admin.book.index')->with('flash_message', $result['passed_count'] . '件登録しました。');
        } else {
            \Log::channel('csv')->error('[CSV取り込み失敗]ファイル名：' . $originalFileName . ', 行数：' . $result['failed_line'] . ', 内容：カラム数が不足もしくは超過しています。');

            return redirect()->route('admin.book.index')->with('flash_message', '登録に失敗しました。CSVファイルに不備があります。');
        }
    }
}
