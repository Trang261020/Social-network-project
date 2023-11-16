<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user (){
        // định nghĩa đảo ngược truy cập model Post từ model User
        return $this->belongsTo(User::class);
    }
    public function fileImg (){
        return $this->hasMany(\App\Models\List_image::class)->orderBy('created_at', 'DESC');
    }
    public function comments (){
        return $this->hasMany(\App\Models\Comment::class)->orderBy('created_at', 'DESC');
    }
}
