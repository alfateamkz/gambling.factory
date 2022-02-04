<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $name;
    protected $lastname;
    protected $avatarPath;

    protected $city;
    protected $country;
    protected $gender;
    protected $login;


    protected $phone;
    protected $email;

    protected $skype;
    protected $vk;
    protected $inst;
    protected $telegram;
    protected $whatsapp;

    protected $referId;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected  $fillable  = [
        'lastname',
        'login',
        'name',
        'email',
        'password',

        'avatarPath',

        'country',
        'city',
        'gender',

        'phone',

        'skype',
        'vk',
        'inst',
        'telegram',
        'whatsapp',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Wallet(){
         return UserWallet::where('user_id',$this->id)->first();
    }
    public function Transactions(){
        return UserTransactions::where('user_id',$this->id)->get();
    }
    public function Tickets(){
        return Ticket::where('user_id',$this->id)->get();
    }
}
