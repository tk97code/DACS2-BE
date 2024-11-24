<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultModel extends Model
{
    protected $table = 'result';

    public $timestamps = false;

    protected $fillable = [
        'test_id',
        'id',
        'mark',
        'elapsed_time',
        'enter_time',
        'number_of_correct',
        'number_of_tab_switches',
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
        $is_entered_test = ResultModel::where('test_id', $test_id)->where('id', $id)->exists();

        return $is_entered_test;
    }

}
