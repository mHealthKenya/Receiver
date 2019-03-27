<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LIMAInbox extends Model
{
    protected $connection = 'lima';
    public $table = 'inbox';
    public $timestamps = false;
    
    protected $fillable = [
        'source','destination','content','receivedtime','reference', 'LinkId' 
    ];
}
