<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'category_id', 'archived'];

    protected $hidden = ['created_at', 'updated_at'];

    public function Categories(){
        return $this->hasMany(Categories::class, 'id');
    }
}
