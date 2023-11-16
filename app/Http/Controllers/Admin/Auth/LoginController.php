<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function adminLogin()
    {
        return view('admin.adminLogin');
    }


    public function adminLoginPost (Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8|max:25',
        ]);
//  kiem tra xac thuc nguoi dung
        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']]))
        {
            return redirect('/admin/dashboard')->with('status','Login successfully.');
        }else{
            return back()->with('status','your username and password are wrong.');
        }
    }
}


