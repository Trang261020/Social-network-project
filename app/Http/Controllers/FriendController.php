<?php

namespace App\Http\Controllers;

use App\Models\FriendUser;
use App\Models\User;
use App\Models\User_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FriendController extends Controller {
    public function show () {
        $friend_add =  DB::table('friend_user')
            ->where(['user_id'=>auth()->id(), 'stastus'=>1])
            ->get();
        $friends = DB::table('users')
            ->join('user_details','users.id', '=', 'user_details.user_id')
            ->get();
        return view('home', compact('friends', 'friend_add'));
    }
    public function add (Request $request) {
        $data = $request->all();
        $friend = FriendUser::where(['user_id'=>auth()->id(),'friend_id'=>$data['id']])->get();
        if ($friend->isEmpty()){
            FriendUser::create(['user_id'=>auth()->id(),'status'=>1, 'friend_id'=>$data['id']]);
            $response['message'] = 'Friend sent successfully';
            $response['key'] = 1;
            return json_encode($response);
        }
        else {
            if($friend[0]->status == 1){
                FriendUser::where(['user_id'=>auth()->id(),'friend_id'=>$data['id']])->delete();
                $response['message'] = 'successfully unfriended';
                $response['key'] = 0;
            }else{
                FriendUser::where(['user_id'=>auth()->id(),'friend_id'=>$data['id']])->update(['status'=>1]);
                $response['message'] = 'Friend sent successfully';
                $response['key'] = 1;
            }
            return json_encode($response);
        }
    }

    public function accept (Request $request) {
        $data = $request->all();
        if($data['action'] == 2){
            FriendUser::where(['user_id'=>$data['id'],'status'=>1, 'friend_id'=>auth()->id()])
                ->update(['status' => 2]);
            $response['message'] = 'Accept successfully.';
            $response['key'] = 2;
        }
        else {
            FriendUser::where(['user_id'=>$data['id'],'status'=>1, 'friend_id'=>auth()->id()])
                ->delete();
            $response['message'] = 'Cancel successfully.';
            $response['key'] = 0;
        }

        return json_encode($response);

    }
}
