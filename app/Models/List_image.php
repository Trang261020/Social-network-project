<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class List_image extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function post(){
        // định nghĩa đảo ngược truy cập model Post từ model User
        return $this->belongsTo(Post::class);
    }
}
