<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'assigned_menus');
    }
    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'assigned_menus');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
