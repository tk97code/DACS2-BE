<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestDetailModel extends Model
{
    protected $table = 'test_detail';

    public $timestamps = false;

    protected $fillable = [
        'test_id', 'question_id', 'question_index'
    ];

    public static function getNumberOfQuestion($test_id) {
        return TestDetailModel::where('test_id', operator: $test_id)->count();
    }

}
