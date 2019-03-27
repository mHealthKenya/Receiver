<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T4AInbox extends Model
{
    protected $connection = 't4a';
    public $table = 'tbl_incoming';
    public $timestamps = false;
    
    protected $fillable = [
    'destination', 'source', 'msg', 'date_fetched', 'reference', 'LinkId'
    ];
}
