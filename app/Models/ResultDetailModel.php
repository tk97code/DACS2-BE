<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultDetailModel extends Model
{
    protected $table = 'result_detail';

    public $timestamps = false;

    protected $fillable = [
        'result_id',
        'question_id',
        'choosed_option_id'
    ];

    public function choosedOption()
    {
        return $this->belongsTo(QuestionOptionModel::class, 'choosed_option_id', 'option_id');
    }
}
