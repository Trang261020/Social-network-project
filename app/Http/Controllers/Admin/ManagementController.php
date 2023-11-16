<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favouriste;
use App\Models\User;
use App\Models\Post;
use App\Models\User_detail;
use http\Env\Response;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Biz\UploadFile\UploadFile;

class ManagementController extends Controller
{
    public function showUser (){
        $user = User::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('user'));
    }
    public function userShow ($id){
        $detail = User::with(['userDetail'])->find($id);
        return view('admin.editUser', ['id'=>$id], compact('detail'));
    }
    public function editUser (Request $request, $id){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'nickname' => 'required',
            'birthday' => 'required',
            'career' => 'required',
            'file_cover' => 'mimes:jpeg,png,jpg',
            'file_avatar' => 'mimes:jpeg,png,jpg',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
       $data = $request->all();
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
        $user = User::find($id)->where(['username'=> $data['username'], 'email'=>$data['email']]);
        if($user){
            User::find($id)->update(['username'=> $data['username'], 'email'=>$data['email']]);
        }
        $user_detail = User_detail::where('user_id', $id)->get();
        if($user_detail->isEmpty()){
            $attributes['user_id'] = $id;
            User_detail::create($attributes);
        }
        else {
            User_detail::where('user_id',$id)->update($attributes);
        }
        $detail = User::with(['userDetail'])->find($id);
        return view('admin.editUser', ['id'=>$id], compact('detail'));
    }
    public function deleteUser ($id){
        if($id){
            User_detail::where('user_id', $id)->delete();
            User::find($id)->delete();
        }
        return redirect('admin/dashboard')->with('message', 'Deleted account successful.');
    }
    public function searchUser (Request $request){
        $data = $request->all();
        $list = User::whereLike(['username', 'email', 'created_at'], $data['key'])->get();
        $html = '';
        $content = '';
        foreach ($list as $key => $item){
            $html .= '<tr>
                                    <td>'. $key+1 .'</td>
                                    <td><a href="'. route('show.user', ['id'=>$item->id]) .'">'. $item->username .'</a></td>
                                    <td><a href="'. route('show.user', ['id'=>$item->id]) .'">'. $item->email .'</a></td>
                                    <td>'. $item->created_at .'</td>
                                    <td>
                                        <a href="'. route('edit.user', ['id'=>$item->id]) .'"><button>Edit</button></a>
                                        <a href="'. route('delete.user', ['id'=>$item->id]) .'"><button class="delete-user">Delete</button></a>
                                    </td>
                                </tr>';
        }
        $content .= '<table>
                                <tr class="title_table">
                                    <th>STT</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Create at</th>
                                    <th>Actions</th>
                                </tr>'.$html.'
                                </table>';
        $response['html'] = $content;
        return json_encode($response);
    }

    public function showPost (){
        $post = Post::orderBy('created_at', 'desc')->get();
        return view('admin.dashboardpost', compact('post'));
    }
    public function postShow ($id){
        $detail = Post::find($id);
        return view('admin.editPost', ['id'=>$id], compact('detail'));
    }
    public function editPost (Request $request, $id){
        $validator = Validator::make($request->all(), [
            'caption' => 'required',
            'description' => 'required',
            'image_video' => 'mimes:jpeg,png,jpg,gif,svg,mp4',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $data = $request->all();
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
        Post::find($id)->update($attributes);
        return redirect()->back()->with('message', 'Edit post success.');
    }
    public function deletePost ($id){
        if($id){
            Favouriste::where('post_id', $id)->delete();
            Post::find($id)->delete();
        }
        return redirect('admin/dashboard/post')->with('message', 'Deleted post successful.');
    }
    public function searchPost (Request $request){
        $data = $request->all();
//        $list = Post::whereLike(['user_id','title', 'content', 'type_post', 'created_at'], $data['key'])->get();
        $list = Post::whereFullText(['title','content'], $data['key'])
                ->get();
        $html = '';
        $content = '';
        foreach ($list as $key => $item){
            $html .= '<tr>
                                    <td>'. $key+1 .'</td>
                                    <td><a href="'. route('show.user', ['id'=>$item->user_id]) .'">'. User::find($item->user_id)->username .'</td>
                                    <td><a href="'. route('show.post', ['id'=>$item->id]) .'">'. $item->title .'</a></td>
                                    <td>'. $item->content .'</td>
                                    <td>'. $item->created_at .'</td>
                                    <td>
                                        <a href="'. route('edit.post', ['id'=>$item->id]) .'"><button>Edit</button></a>
                                        <a href="'. route('delete.post', ['id'=>$item->id]) .'"><button class="delete-user">Delete</button></a>
                                    </td>
                                </tr>';
        }
        $content .= '<table>
                                <tr class="title_table">
                                            <th>STT</th>
                                            <th>User</th>
                                            <th>Status</th>
                                            <th>Content</th>
                                            <th>Create at</th>
                                            <th>Actions</th>
                                        </tr>'.$html.'
                                </table>';
        $response['html'] = $content;
        return json_encode($response);
    }
}
