<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOptionModel extends Model
{
    protected $table = 'question_option';

    protected $primaryKey = 'question_id';

    public $timestamps = false;

    protected $fillable = [
        'option_id', 'question_id', 'option_content', 'is_answer'
    ];

    // public static function getQuestionOption($question_id) {
    //     $options = QuestionOptionModel::where('question_id', $question_id)->get();
        
    //     return $options;
    // }
}
