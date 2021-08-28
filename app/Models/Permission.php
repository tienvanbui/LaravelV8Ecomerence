<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
class Permission extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function permissions(){
        return $this->hasMany(Permission::class,'parent_id');
    }
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
