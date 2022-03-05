<?php

use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendances')->truncate();
        DB::table('attendances')->insert([
            [
                'user_id' => 500,
                'date' => '2021-10-15',
                'start_time' => '10:00:00',
                'end_time' => '19:00:00',
                'is_absent' => 0,
                'absent_reason' => null,
                'request_content' => null,
            ],
            [
                'user_id' => 500,
                'date' => '2021-10-16',
                'start_time' => '9:31:00',
                'end_time' => '19:00:00',
                'is_absent' => 0,
                'absent_reason' => null,
                'request_content' => null,
            ],
            [
                'user_id' => 500,
                'date' => '2021-10-17',
                'start_time' => null,
                'end_time' => null,
                'is_absent' => 1,
                'absent_reason' => 'コロナの副反応により' . PHP_EOL . '学習できる体調ではないため。',
                'request_content' => null,
            ],
            [
                'user_id' => 500,
                'date' => '2021-10-18',
                'start_time' => '11:00:00',
                'end_time' => '19:00:00',
                'is_absent' => 0,
                'absent_reason' => null,
                'request_content' => '本当は10:00に始業していたのですが、始業報告を忘れたため11:00の打刻になっています。' . PHP_EOL . '修正お願いします。'
            ],
            [
                'user_id' => 500,
                'date' => '2021-10-19',
                'start_time' => '12:00:00',
                'end_time' => '19:00:00',
                'is_absent' => 0,
                'absent_reason' => null,
                'request_content' => null,
            ],
        ]);
    }
}
