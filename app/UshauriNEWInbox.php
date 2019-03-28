<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UshauriNEWInbox extends Model
{
    protected $connection = 'ushauri_new';
    public $table = 'tbl_incoming';
    public $timestamps = false;
    
    protected $fillable = [
    'destination', 'source', 'msg', 'receivedtime', 'reference', 'LinkId'
    ];

}
