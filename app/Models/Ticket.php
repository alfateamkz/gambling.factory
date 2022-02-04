<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "tickets";

    protected  $fillable  = [
        'user_id',
        'header',
        'description',
    ];

    use HasFactory;
    protected $user_id;
    protected $header;
    protected $description;

    public function Messages(){
        return TicketMessage::where('ticket_id',$this->id)->get();
    }
    public function LastMessage(){
        return TicketMessage::where('ticket_id',$this->id)->first();
    }
}
