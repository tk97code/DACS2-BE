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
}
