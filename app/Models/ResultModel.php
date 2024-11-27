<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ResultModel extends Model
{
    protected $table = 'result';

    public $timestamps = false;

    protected $fillable = [
        'test_id',
        'id',
        'score',
        'elapsed_time',
        'enter_time',
        'number_of_correct',
        'number_of_tab_switches',
        'submitted'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id'); // Liên kết với bảng users
    }

    public function test()
    {
        return $this->belongsTo(TestModel::class, 'test_id', 'test_id'); // Liên kết với bảng test
    }

    public static function isEnteredTest($id, $test_id) {
        $result = ResultModel::where('test_id', $test_id)->where('id', $id)->first();
        if (isset($result->enter_time)) {
            $is_entered_test = ResultModel::where('test_id', $test_id)->where('id', $id)->exists();
        } else {
            $is_entered_test = false;
        }

        return $is_entered_test;
    }

    public static function submitted($id, $test_id) {
        $result = ResultModel::where('test_id', $test_id)->where('id', $id)->first();
        $submitted = $result->submitted;

        return $submitted;
    }

    public static function checkAndUpdateSubmission($result_id)
    {
        $result = ResultModel::where('result_id', $result_id)->first();

            if ($result) {
                // Lấy thông tin thời gian kết thúc của bài thi
                $test = TestModel::where('test_id', $result->test_id)->first();
                $current = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString(); // Thời gian hiện tại
                // $end = Carbon::createFromFormat('Y-m-d H:i:s', $test->end_time);

                $current_time = Carbon::createFromFormat('Y-m-d H:i:s', $current)->timezone('Asia/Ho_Chi_Minh');
                $end_time = Carbon::createFromFormat('Y-m-d H:i:s', time: $test->end_at)->timezone('Asia/Ho_Chi_Minh');

                $enter = $result->enter_time ?? $current;


                $curent_time = Carbon::createFromFormat('Y-m-d H:i:s', $current)->timezone('Asia/Ho_Chi_Minh');
                $enter_time = Carbon::createFromFormat('Y-m-d H:i:s', $enter)->timezone('Asia/Ho_Chi_Minh');

                $time_passed = -$curent_time->diffInSeconds($enter_time);

                // Nếu thời gian hiện tại đã vượt qua thời gian kết thúc và chưa nộp bài
                if ($current_time->greaterThan($end_time) || $test->time_do_test * 60 - $time_passed < 0) {
                    // Cập nhật trường submitted thành 1
                    ResultModel::where('result_id', $result->result_id)->update(['submitted' => 1]);
                    // $result->save();
                    // info($result->submitted);
                }
                // info( $current_time->greaterThan($end_time));
            }
    }

}
