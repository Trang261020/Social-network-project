<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
    use HasFactory;
    protected $fillable = ['nick_name','gender','birthday','avatar','background','career','user_id'];

    public function user (){
        return $this->belongsTo(User::class);
    }
}
