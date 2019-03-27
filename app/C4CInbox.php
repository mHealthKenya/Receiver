<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class C4CInbox extends Model
{
    protected $connection = 'c4c';
    public $table = 'tbl_logs_inbox';
    public $timestamps = false;
    
    protected $fillable = [
    'shortCode', 'mobile_no', 'msg', 'date_fetched', 'msgID',  'LinkId'
    ];
}
