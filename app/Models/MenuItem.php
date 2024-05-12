<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'url', 'menu_id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'assigned_menus');
    }
}
