<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouristeComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'comment_id',
        'likes',
    ];
    public function user (){
        return $this->belongsTo(User::class);
    }

    public function comment (){
        return $this->belongsTo(Comment::class);
    }
}
