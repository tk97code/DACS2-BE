<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassDetailModel extends Model
{
    protected $table = 'class_detail';

    // protected $primaryKey = ['class_id', 'id'];

    public $timestamps = false;

    protected $fillable = [
        'class_id', 'id'
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'class_id');
    }

    public static function getStudentClasses($studentId) {
        $classes = ClassDetailModel::with('class')
            ->where('id', $studentId)
            ->get()
            ->map(function ($detail) {
                return $detail->class;
            });

        return $classes;
    }
}
