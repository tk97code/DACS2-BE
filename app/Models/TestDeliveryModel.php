<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestDeliveryModel extends Model
{
    protected $table = 'test_delivery';


    public $timestamps = false;

    protected $fillable = [
        'test_id', 'class_id'
    ];

    public function class() {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public static function canAccessTest($testId, $userId)
    {
        $classIds = self::where('test_id', $testId)->pluck('class_id');

        // Kiểm tra xem user có thuộc bất kỳ lớp học nào liên kết với bài kiểm tra không
        $isInClass = ClassDetailModel::whereIn('class_id', $classIds)
            ->where('id', $userId)
            ->exists();

        return $isInClass;
    }
}
