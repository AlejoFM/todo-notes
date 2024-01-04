<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'categories_id', 'archived'];

    protected $hidden = ['created_at', 'updated_at'];

    public function Categories(){
        return $this->belongsToMany(Categories::class, 'note_category', 'notes_id', 'category_id');
    }
}
