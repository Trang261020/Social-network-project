<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Favouriste;
use App\Models\List_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Biz\UploadFile\UploadFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'caption' => 'required',
            'description' => 'required',
            'image_video' => 'mimes:jpeg,png,jpg,gif,svg,mp4|max:2MB',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $value = $request->all();
        $data['image_video'] = '';
        $type = 3;
        if(isset($value['image_video'])){
            /*---------------- XỬ LÝ FILE LƯU FILE VÀO storage/app/public ------------------------*/
            $file = $request->file('image_video');
            $imageName = time() . '.' . $file->extension();
            Storage::disk('public')->put('/post_images/' . $imageName, $file->getContent());
            $data['image_video'] = 'post_images/' . $imageName;
            /*------------------ END ---------------------------------------------*/
            if($file->extension() == 'mp4'){
                $type = 2;
            }else {
                $type = 1;
            }
        }

        auth()->user()->posts()->create([
            'title' => $value['caption'],
            'content'=> $value['description'],
            'file' => $data['image_video'],
            'type_post' => $type
        ]);
        return redirect()->route('home')->with('message', 'Publish post success.');
    }

    public function delete ($id) {
        Favouriste::where('post_id', '=', $id)->delete();
        auth()->user()->posts()->find($id)->delete();
        return redirect()->route('home')->with('message', 'Deleted post success.');
    }

    public function index($id){
        $user = auth()->user();
        $detail = $user->posts()->find($id);
        return view('posts.edit',['id'=>$id],compact('detail'));
    }

    public function edit (Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'caption' => 'required',
            'description' => 'required',
            'image_video' => 'mimes:jpeg,png,jpg,gif,svg,mp4|max:2MB',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $data = $request->all();
        $user = auth()->user();
        $attributes = [
            'title'=> $data['caption'],
            'content'=> $data['description'],
        ];
        $attributes['type_post'] = $data['type_post'];
        if($request->hasFile('image_video')){
            $cover = UploadFile::uploadFile($request->file('image_video'), 'post_images');
            $file = $request->file('image_video');
            if($file->extension() == 'mp4'){
                $type = 2;
            }else {
                $type = 1;
            }
            $attributes['file'] = $cover;
            $attributes['type_post'] = $type;
        }
        $user->posts()->find($id)->update($attributes);
        return redirect()->route('home')->with('message', 'Edit post success.');
    }

    public function show (){
        // Lấy danh sách user và detail_user
        $list_post = Post::with(['user.userDetail'])->orderBy('updated_at', 'desc')->get();
       //Join bảng user và friend_user
        $friend_add = DB::table('friend_user')
            ->join('user_details','friend_user.friend_id', '=', 'user_details.user_id')
            ->where(['friend_user.user_id'=>auth()->id(), 'friend_user.status'=>1])
            ->get();
        //Query friend
        $friend_waiting = DB::table('friend_user')
            ->join('user_details','friend_user.user_id', '=', 'user_details.user_id')
            ->where(['friend_user.friend_id'=>auth()->id(), 'friend_user.status'=>1])
            ->get();
        //Join bảng user và friend_user điều kiện friend_user.status=1
        $join =  DB::table('users')
            ->join('friend_user','users.id', '=', 'friend_user.friend_id')
            ->where('friend_user.status','=', 1)
            ->get();
        $list_id = [];
        // Lọc id theo status
        foreach ($join as $key => $value){
            $list_id[$key] = $value->friend_id;
        }
        //query user, detail_user điều kiện không thuộc danh sách id đã lọc
        $friends = DB::table('users')
            ->join('user_details','users.id', '=', 'user_details.user_id')
            ->whereNotIn('users.id', $list_id)
            ->get();

        return view('home', compact('list_post', 'friends', 'friend_add', 'friend_waiting'));
    }

    public function like (Request $request){
        $data = $request->all();
        $response = [];
        $check = auth()->user()->like()->where('post_id', $data['id'])->get();
        if(!empty($check[0])){
                auth()->user()->like()->where('post_id', $data['id'])->delete();
                $response['number'] = Favouriste::where(['post_id'=>$data['id']])->count();
                $response['data'] = 0;
                return json_encode($response) ;
        }
        auth()->user()->like()->create([
            'post_id'=> $data['id'],
            'likes'=> 1,
        ]);
        $response['number'] = Favouriste::where(['post_id'=>$data['id']])->count();
        $response['data'] = 1;
        return json_encode($response) ;
    }

    public function showLike (){
        $list_post = DB::table('favouristes')
            ->join('posts', function ($join) {
                $join->on('favouristes.post_id', '=', 'posts.id')
                    ->where(['favouristes.user_id' => auth()->id(), 'favouristes.likes' =>1]);
                })
            ->get();
        //Join bảng user và friend_user
        $friend_add = DB::table('friend_user')
            ->join('user_details','friend_user.friend_id', '=', 'user_details.user_id')
            ->where(['friend_user.user_id'=>auth()->id(), 'friend_user.status'=>1])
            ->get();
        //Query friend
        $friend_waiting = DB::table('friend_user')
            ->join('user_details','friend_user.user_id', '=', 'user_details.user_id')
            ->where(['friend_user.friend_id'=>auth()->id(), 'friend_user.status'=>1])
            ->get();
        //Join bảng user và friend_user điều kiện friend_user.status=1
        $join =  DB::table('users')
            ->join('friend_user','users.id', '=', 'friend_user.friend_id')
            ->where('friend_user.status','=', 1)
            ->get();
        $list_id = [];
        // Lọc id theo status
        foreach ($join as $key => $value){
            $list_id[$key] = $value->friend_id;
        }
        //query user, detail_user điều kiện không thuộc danh sách id đã lọc
        $friends = DB::table('users')
            ->join('user_details','users.id', '=', 'user_details.user_id')
            ->whereNotIn('users.id', $list_id)
            ->get();

        return view('posts.like', compact('list_post','friends','friend_add','friend_waiting'));
    }

    public function comment (Request $request){

        $data = $request->all();
        $value = [
            'post_id' => $data['id'],
            'description' => $data['content'],
            'parent_id' => $data['parent_id'],
        ];
        auth()->user()->comments()->create($value);
        $response['html'] = 'Sent comment.';
        return json_encode($response) ;

    }

    public function likeComment (Request $request){
        $data = $request->all();
        $response = [];
        $check = auth()->user()->likeComment()->where('comment_id', $data['id'])->get();
        if(!empty($check[0])){
                auth()->user()->likeComment()->where('comment_id', $data['id'])->delete();
                $response['data'] = 0;
                return json_encode($response) ;
        }
        auth()->user()->likeComment()->create([
            'post_id'=> $data['id_post'],
            'comment_id'=> $data['id'],
            'likes'=> 1,
        ]);
        $response['data'] = 1;
        return json_encode($response) ;
    }

}
