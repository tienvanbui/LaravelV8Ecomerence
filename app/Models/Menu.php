<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $fillable = [
        'menu_name',
        'parent_id',
        'slug',
    ];
    public function menus(){
        return $this->hasMany(Menu::class,'parent_id');
    }
}
