<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'class';

    protected $primaryKey = 'class_id';

    public $timestamps = false;

    protected $fillable = [
        'class_id', 'class_name', 'class_note', 'creator_id', 'invite_code'
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function tests() {
        return $this->belongsToMany(TestModel::class, 'test_delivery', 'class_id', 'test_id');
    }
    
    public static function getTestOfClass($class_id) {
        // Lấy thông tin lớp học
        $class = ClassModel::find($class_id);
        
        if ($class) {
            // Trả về danh sách bài kiểm tra liên quan đến lớp
            return $class->tests;
        }

        // Nếu không tìm thấy lớp, trả về null hoặc thông báo lỗi
        return null;
    }
}
