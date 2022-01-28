<?php

namespace App\Http\Controllers;

use App\Models\TradeModel;
use App\Models\UserModel;
use http\Env\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends BaseController
{
    public function index(){
        return view('index');
    }
    public function signup(Request $request){

    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'login'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('main');
        }

        return back()->withErrors([
            'login' => 'Неверный логин или пароль',
        ]);
    }


   public function exchange(){
       return view('exchange');
   }
   public function finance(){
        return view('finance');
    }
    public function main(){
        return view('main');
    }
    public function platforms(){
        return view('platforms');
    }
    public function settings(){
        return view('settings');
    }
    public function support(){
        return view('support');
    }
    public function team(){
        return view('team');
    }
    public function ticket(){
        return view('ticket');
    }
    public function transfer(){
        return view('transfer');
    }
    public function upbalance(){
        return view('upbalance');
    }
    public function updates(){
        return view('updates');
    }
    public function withdraw(){
        return view('withdraw');
    }
}
