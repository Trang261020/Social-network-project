<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function createUser($data)
    {
        self::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
//            bcrypt
        ]);
    }
    public function posts (){
        return $this->hasMany(\App\Models\Post::class)->orderBy('created_at', 'DESC');
    }
    public function like (){
        return $this->hasMany(\App\Models\Favouriste::class)->orderBy('created_at', 'DESC');
    }
    public function userDetail () {
        return $this->hasOne(User_detail::class);
    }
    public function friends () {
        return $this->belongsToMany(FriendUser::class);
    }
    public function comments (){
        return $this->hasMany(\App\Models\Comment::class)->orderBy('created_at', 'DESC');
    }
    public function likeComment (){
        return $this->hasMany(\App\Models\FavouristeComment::class)->orderBy('created_at', 'DESC');
    }
}
