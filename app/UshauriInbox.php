<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UshauriInbox extends Model
{
    protected $connection = 'ushauri';
    public $table = 'tbl_incoming';
    public $timestamps = false;
    
    protected $fillable = [
    'destination', 'source', 'msg', 'receivedtime', 'reference', 'LinkId'
    ];

}
