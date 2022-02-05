<?php

namespace App\Http\Controllers;

use App\Models\GFRates;
use App\Models\Platform;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\TradeModel;
use App\Models\UpdateModel;
use App\Models\User;
use App\Models\UserModel;
use App\Models\UserWallet;
use http\Env\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Ramsey\Uuid\Guid\Guid;
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
    public function logout(){
        auth()->logout();
        return redirect('/');
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
       return view('exchange')->with([
           'gfRates'=>GFRates::getRates()
       ]);
   }
    public function sellToken(\Illuminate\Http\Request $request){

        $user = auth()->user();

        if($user->Wallet()->gfBalance < $request['sell_gf_count'])
            return 'Недостаточно токенов';


        TradeModel::create([
            'user_id'=>$user->id,
            'isActiveTrade'=>true,
            'unsoldTokensCount' => $request['sell_gf_count']/2,
            'isBuyOperation'=>false,
            'amount' => $request['sell_gf_count'],
            'priceForOne' => $request['sellPriceForOne'],
            'usdVolumes' => TradeModel::getUSDVolume(),
        ]);


       $wallet= $user->Wallet();
       $wallet->gfBalance -= $request['sell_gf_count'];
       $wallet->usdBalance += $request['sell_gf_count'] * $request['sellPriceForOne'];
       $wallet->save();

        return redirect(route('exchange'));
    }
    public function buyToken(\Illuminate\Http\Request $request){

        $user = auth()->user();
        $rates = GFRates::getRates();

        if($user->Wallet()->usdBalance < $request['buy_gf_count']*$rates->buyUSDPrice)
            return 'Недостаточно долларов';


        TradeModel::create([
            'user_id'=>$user->id,
            'isActiveTrade'=>true,
            'unsoldTokensCount' => $request['buy_gf_count']/2,
            'isBuyOperation'=>true,
            'amount' => $request['buy_gf_count'],
            'priceForOne' => $rates->buyUSDPrice,
            'usdVolumes' => TradeModel::getUSDVolume(),
        ]);


        $wallet= $user->Wallet();
        $wallet->gfBalance += $request['buy_gf_count'];
        $wallet->usdBalance -= $request['buy_gf_count']*$rates->buyUSDPrice;
        $wallet->save();

        MainController::increaseRates($request['buy_gf_count']*$rates->buyUSDPrice);
        return redirect(route('exchange'));
    }

    public function increaseRates($dollars){
        $rates = GFRates::getRates();
        $rates->buyUSDPrice += $rates->buyUSDPrice/100000*$dollars;
        $rates->sellUSDPrice += $rates->sellUSDPrice/100000*$dollars;
        $rates->save();
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

    public function team(){
        return view('team');
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
            ]);
    }

    public function support(){
        return view('support')->with(['tickets'=>auth()->user()->Tickets()]);
    }
    public function supportCreateTicket(\Illuminate\Http\Request $request){

        $ticket =  Ticket::create([
            'header' => $request['ticket-header'],
            'description' => $request['ticket-message'],
            'user_id' => auth()->user()->id,
        ]);
        $attachment1path = "";
        $attachment2path = "";

        if ($request->hasFile('attachment-1')) {
            $file1 = $request->file('attachment-1');
            $destinationPath = public_path('uploads/attachments/');
            $fileName = Guid::uuid4() .$file1->getClientOriginalName();
            $request->file('attachment-1')->move($destinationPath, $fileName);
            $attachment1path = 'uploads/attachments/' . $fileName;
        }
        if ($request->hasFile('attachment-2')) {
            $file2 = $request->file('attachment-1');
            $destinationPath = public_path('uploads/attachments/');
            $fileName = Guid::uuid4() . $file2->getClientOriginalName();
            $request->file('attachment-2')->move($destinationPath, $fileName);
            $attachment2path = 'uploads/attachments/' . $fileName;
        }
        $msg =  TicketMessage::create([
            'ticket_id' => $ticket->id,
            'fromSupport' => false,
            'header' => $request['ticket-header'],
            'description' => $request['ticket-message'],
            'attachment1path' => $attachment1path,
            'attachment2path' => $attachment2path,
        ]);


        return view('support')->with(['tickets'=>auth()->user()->Tickets()]);
    }

    public function ticket($id){

        $ticket = Ticket::where('id',$id)->first();
        if($ticket->user_id != auth()->user()->id)
            return '403';

        return view('ticket')->with(['ticket' => $ticket]);
    }

    public function ticketCreateMessage(\Illuminate\Http\Request $request){
        $ticket =  Ticket::where('id',$request['ticket_id'])->first();
        $attachment1path = "";
        $attachment2path = "";

        if ($request->hasFile('attachment-1')) {
            $file1 = $request->file('attachment-1');
            $destinationPath = public_path('uploads/attachments/');
            $fileName = Guid::uuid4() .$file1->getClientOriginalName();
            $request->file('attachment-1')->move($destinationPath, $fileName);
            $attachment1path = 'uploads/attachments/' . $fileName;
        }
        if ($request->hasFile('attachment-2')) {
            $file2 = $request->file('attachment-1');
            $destinationPath = public_path('uploads/attachments/');
            $fileName = Guid::uuid4() . $file2->getClientOriginalName();
            $request->file('attachment-2')->move($destinationPath, $fileName);
            $attachment2path = 'uploads/attachments/' . $fileName;
        }
        $msg =  TicketMessage::create([
            'ticket_id' => $ticket->id,
            'fromSupport' => false,
            'header' => $request['ticket-header'],
            'description' => $request['ticket-message'],
            'attachment1path' => $attachment1path,
            'attachment2path' => $attachment2path,
        ]);

        return redirect(route('ticket',['id'=>$request['ticket_id']]));
    }
}
