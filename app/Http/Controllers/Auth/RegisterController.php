<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    protected $modelUser; // Khai bao 1 doi tuong
    public function __construct()
    {
//        $this->modelUser = new User(); // xac dinh gia tri cho doi tuong da khai bao
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:16',
            'password_confirmation' => 'required|same:password',
        ],
//            [
//            'email.unique'=>'Email đã tồn tại.',
//            ]
        );
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['username'] =  $user->username;
            return redirect()->route('login')->with('message','Registration successful');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    protected function login(Request $request)
    {
        if(Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['username'] =  $user->username;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

}
