<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use PDO;

class AccountController extends Controller
{
    public function index(){
        return view('user/user_login');
    }

    public function regist(Request $request){
        $account = new Account();
        $account->username = $request->username;
        $account->email = $request->email;
        $account->password = Hash::make($request->input('password'));
        $account->save();
        return redirect('/');
    }
    
    public function login(Request $request){
        $data = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        if(Auth::guard("accounts")->attempt($data)){
            // $regist= Auth::guard("accounts")->user();
            return redirect('/home');
            // session(['user' => $regist->email]);
        }else{
            session()->flash('errors', ['Check Your Username And Password is Correct']);
            return redirect()->back();
        }
    }

    
    public function adminLogin(Request $request){
        $admin = "admin@gmail.com";
        $pass = "123";
        if($request->email==$admin && $request->password == $pass){
            session(['admin_login' => true]);
            return redirect('/admin');
        }else{
            session()->flash('errors', ['Check Your Username And Password is Correct']);
            return redirect()->back();
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
