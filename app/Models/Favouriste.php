<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favouriste extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','user_id','likes'];
    public function user(){
        // định nghĩa đảo ngược truy cập model Favouriste từ model Post
        return $this->belongsTo(User::class);
    }
}
