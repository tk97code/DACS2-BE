<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    protected $table = 'test';

    protected $primaryKey = 'test_id';

    protected $fillable = [
        'test_id', 'test_name', 'creator_id', 'create_on', 'start_at', 'end_at',
        'time_do_test', 'allow_show_anwser', 'allow_show_mark', 'is_shuffle'
    ];
}
