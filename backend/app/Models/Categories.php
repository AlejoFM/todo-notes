<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    public function Notes(){
        return $this->belongsToMany(Notes::class,'note_category', 'category_id', 'notes_id');
    }
}
