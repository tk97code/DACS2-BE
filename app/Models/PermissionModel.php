<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{

    protected $table = 'permission';

    protected $primaryKey = 'permission_id';

    public function users()
    {
        return $this->hasMany(User::class, 'permission_id');
    }

}
