<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected $table = "ticket_messages";
    protected  $fillable  = [
        'ticket_id',
        'fromSupport',
        'header',
        'description',
        'attachment1path',
        'attachment2path',
    ];
    use HasFactory;
    protected $ticket_id;
    protected $fromSupport;
    protected $header;
    protected $description;
    protected $attachment1path;
    protected $attachment2path;
}
