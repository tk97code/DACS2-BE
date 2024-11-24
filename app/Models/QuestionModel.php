<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    protected $table = "question";

    protected $primaryKey = 'question_id';

    public $timestamps = false;         

    protected $fillable = [
        'question_id', 'question_content'
    ];

    public function options() {
        return $this->hasMany(QuestionOptionModel::class, 'question_id', localKey: 'question_id');
    }

    public static function getTestQuestion($test_id) {
        $test_detail = TestDetailModel::where('test_id', $test_id)->get();

        // return $test_detail;
        $questions = [];
        foreach ($test_detail as $detail) {
            $question = QuestionModel::where('question_id', $detail->question_id)->first();
            array_push($questions, $question);
        }

        return $questions;
    } 

}
