<?php

namespace App\Models;

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
}