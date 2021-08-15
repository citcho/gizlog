<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $table = 'books';

    private function makeSplFileObject(string $filePath)
    {
        setlocale(LC_ALL, 'ja_JP.UTF-8');

        $csv = new \SplFileObject($filePath);
        $csv->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        return $csv;
    }

    private function makeBookAttributes(array $line): array
    {
        return [
            'user_id' => $line[1],
            'title' => $line[2],
            'author' => $line[3],
            'publisher' => $line[4],
            'price' => $line[5],
            'purchase_date' => date('Y-m-d', strtotime($line[6])),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function bulkInsert(string $filePath)
    {
        $csv = $this->makeSplFileObject($filePath);

        $insertableBookArray = [];

        foreach ($csv as $lineNum => $line) {

            // 一行目はスキップ
            if ($lineNum === 0) {
                continue;
            }

            // カラムが全て埋まっていなかった場合はスキップ
            if (count($line) !== 7) {
                $failedNum[] = $lineNum;
                continue;
            }

            // 行情報をinsert()引数に受け入れ可能な配列へ変換
            $insertableBookArray[] = $this->makeBookAttributes($line);

            // 500件溜まったタイミングでinsert処理実行
            if (count($insertableBookArray) === 500) {
                $this->insert($insertableBookArray);
                $insertableBookArray = [];
            }
        }

        // 500件未満の余りをinsert
        if (! empty($insertableBookArray)) {
            $this->insert($insertableBookArray);
        }

        return 0;
    }
}
