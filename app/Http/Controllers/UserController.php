<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Biz\UploadFile\UploadFile;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show($id){
        if($id != auth()->id()){
            $list_post = Post::with(['user.userDetail'])->where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();
            $friend = DB::table('friend_user')
                ->join('user_details','friend_user.friend_id', '=', 'user_details.user_id')
                ->where(['friend_user.user_id'=>$id, 'friend_user.status'=>2])
                ->get();
            return view('user.profile', ['user'=>$id], compact('list_post', 'friend'));
        }
        else {
            $list_post = auth()->user()->posts()->get();
            $friend = DB::table('friend_user')
                ->join('user_details','friend_user.friend_id', '=', 'user_details.user_id')
                ->where(['friend_user.user_id'=>auth()->id(), 'friend_user.status'=>2])
                ->get();
//            dd($friend);
            return view('user.profile', ['user'=>auth()->id()], compact('list_post', 'friend'));
        }
    }
    public function index(){
        $user = auth()->user();
        $detail = $user->userDetail;
        return view('user.edit',compact('detail'));
    }

    public function edit (Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nickname' => 'required',
            'birthday' => 'required',
            'career' => 'required',
            'file_cover' => 'mimes:jpeg,png,jpg|max:2MB',
            'file_avatar' => 'mimes:jpeg,png,jpg|max:2MB',
        ]);

        if($validator->fails()){
            return redirect('profile')->withErrors($validator->errors());
        }
        $data = $request->all();
        $user = auth()->user();
        $attributes = [
            'nick_name'=> $data['nickname'],
            'gender'=> $data['gender'],
            'birthday'=> $data['birthday'],
            'career'=> $data['career'],
        ];
        if($request->hasFile('file_cover')){
            $cover = UploadFile::uploadFile($request->file('file_cover'));
            $attributes['background'] = $cover;
        }
        if($request->hasFile('file_avatar')){
            $avatar = UploadFile::uploadFile($request->file('file_avatar'), 'avatar_image');
            $attributes['avatar'] = $avatar;
        }

        if($user->userDetail){
            $detail = $user->userDetail()->update($attributes);
        }
        else {
            $detail = $user->userDetail()->create($attributes);
        }
        return redirect('profile')->with($detail);
    }
}
