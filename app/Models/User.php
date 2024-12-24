<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

// use Illuminate\Contracts\Auth\Authenticatable;

class User extends Authenticatable
{
    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'users';

    // Nếu bảng không có các trường `created_at` và `updated_at`
    public $timestamps = false;

    protected $fillable = [
        'email', 'id', 'google_id', 'name', 'gender', 'dob', 
        'avatar', 'join_date', 'password', 'status', 'phone_number', 'address',
        'token', 'otp', 'permission_id'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function permission() {
        return $this->belongsTo(PermissionModel::class, 'permission_id');
    }

    public function class(){
        return $this->hasMany(ClassModel::class, 'creator_id');
    }

    // Các thuộc tính có giá trị mặc định
    protected $attributes = [
        'dob' => null,
        'status' => '1',
        // 'permission_id' => 1, // Ví dụ: mặc định là 1, bạn có thể điều chỉnh theo nhu cầu
    ];
}
