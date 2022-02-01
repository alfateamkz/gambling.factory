<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use App\Models\TradeModel;
use App\Models\UpdateModel;
use App\Models\User;
use App\Models\UserModel;
use App\Models\UserWallet;
use http\Env\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Validator;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class MainController extends BaseController
{
    public function index(){
        return view('index');
    }
    public function signup(\Illuminate\Http\Request $request){
       $user =  User::create([
            'login' => $request['login'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        UserWallet::create([
             'usdBalance' => 0,
             'gfBalance' => 0,
             'user_id' => $user->id
        ]);
        return redirect('/');
    }
    public function login(\Illuminate\Http\Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required' ],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/main');
        }

        return redirect()->intended('/');
    }
    public function changePassword(\Illuminate\Http\Request $request){
        $data = $request->all();
        $userinput['login'] = $data['login'];

        if(!Hash::check($data['password'], auth()->user()->password)){
            return "Неверный пароль";
        }

        if($data['new-password']){
            if($data['new-password'] == $data['repeat-password']) {
                $userinput['password'] =  Hash::make($data['new-password']);
            }
            return "Пароли не совпадают";
        }
        $user = User::where('login',$userinput['login'])->first();
        $user->update($userinput);
        return redirect('/main');
    }
    public function editUserInfo(\Illuminate\Http\Request $request){
        $data = $request;
        if ($request->hasFile('photo')) {
            $destinationPath = public_path('uploads/avatars/');
            $fileName = auth()->user()->id . '.jpg';
            $request->file('photo')->move($destinationPath, $fileName);
            $data = $request->except('photo');
            $data['avatarPath']  = 'uploads/avatars/' . $fileName;
            auth()->user()->update($data);
            return redirect('/main');
        }
        $data = $request->except('photo');
        auth()->user()->update($data);
        return redirect('/main');
    }


   public function exchange(){
       return view('exchange');
   }
   public function finance(){
        return view('finance')->with(
            [
                'transactions' =>auth()->user()->Transactions()
            ]);
    }
    public function main(){
        return view('main')->with(['updates'=>UpdateModel::all()]);
    }
    public function platforms(){
        return view('platforms')->with(['platforms'=>Platform::all()]);
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
    public function transfer(\Illuminate\Http\Request $request){

        if(!isset($request['username'])|| strlen($request['username'])==0)
            return 'У вас нет доступа к этой странице';

        $user = User::where('login',$request['username'])->first();
        if(!isset($user))
            return 'Пользователя с таким юзернеймом не существует';

        return view('transfer')->with(
                [
                    'receiver' => $user,
                    'currency'=>$request['currency']
                ]);
    }
    public function upbalance(\Illuminate\Http\Request $request){
        return view('upbalance')->with(
            [
                'currency' => $request['currency'],
                'sum' =>$request['sum']
            ]);;
    }
    public function updates(){
        return view('updates')->with(['updates'=>UpdateModel::all()]);
    }
    public function withdraw(\Illuminate\Http\Request $request){
        return view('withdraw')->with(
            [
                'currency' => $request['currency'],
                'sum' =>$request['sum']
            ]);;
    }
}
