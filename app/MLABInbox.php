<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MLABInbox extends Model
{
    protected $connection = 'mlab';
    public $table = 'inbox';
    public $timestamps = false;
    
    protected $fillable = [
    'shortCode', 'MSISDN', 'message', 'msgDateCreated', 'createdOn', 'message_id', 'processed', 'LinkId'
    ];
}
