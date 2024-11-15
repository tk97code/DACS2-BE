<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'class';

    protected $primaryKey = 'class_id';

    public $timestamps = false;

    protected $fillable = [
        'class_id', 'class_name', 'class_note', 'creator_id'
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
