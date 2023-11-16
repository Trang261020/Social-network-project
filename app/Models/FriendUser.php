<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendUser extends Model
{
    use HasFactory;
    protected $table="friend_user";
        protected $fillable = [
        'user_id',
        'status',
        'friend_id',
    ];
    public function user (){
        return $this->belongsToMany(User::class);
    }
}
