<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    protected $table = 'test';

    protected $primaryKey = 'test_id';

    public $timestamps = false;

    protected $fillable = [
        'test_id', 'test_name', 'creator_id', 'created_on', 'start_at', 'end_at',
        'time_do_test', 'allow_show_answer', 'allow_show_mark', 'is_shuffle'
    ];

    public function classes() {
        return $this->belongsToMany(ClassModel::class, 'test_delivery', 'test_id', 'class_id');
    }
    
    public static function getTestDetail($test_id) {
        $test = TestModel::where('test_id', $test_id)->first();
        return $test;
    }

    public static function checkAndUpdateSubmission($result_id)
    {
        $result = ResultModel::find($result_id);

        if ($result) {
            // Lấy thông tin thời gian kết thúc của bài thi
            $test = $result->test;
            $current_time = Carbon::now('Asia/Ho_Chi_Minh'); // Thời gian hiện tại
            $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $test->end_at);

            // Nếu thời gian hiện tại đã vượt qua thời gian kết thúc và chưa nộp bài
            if ($current_time > $end_time && $result->submitted == 0) {
                // Cập nhật trường submitted thành 1
                $result->submitted = 1;
                $result->save();
            }
        }
    }
}