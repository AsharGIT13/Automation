<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function sub_category()
    {
        return $this->hasOne(Subcategory::class);
    }
}
