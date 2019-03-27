<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T4AUshauriInbox extends Model
{
    protected $connection = 't4a_ushauri';
    public $table = 'tbl_incoming';
    public $timestamps = false;
    
    protected $fillable = [
    'destination', 'source', 'msg', 'receivedtime', 'reference', 'LinkId'
    ];
}
