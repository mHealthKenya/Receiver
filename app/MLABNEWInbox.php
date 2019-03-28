<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MLABNEWInbox extends Model
{
    protected $connection = 'pgsql';
    public $table = 'inbox';
    public $timestamps = false;
    
    protected $fillable = [
    'shortCode', 'MSISDN', 'message', 'msgDateCreated', 'createdOn', 'message_id', 'processed', 'LinkId'
    ];
}
