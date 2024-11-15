<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOptionModel extends Model
{
    protected $table = 'question_option';

    protected $primaryKey = 'question_id';
}
