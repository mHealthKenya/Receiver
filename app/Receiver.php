<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    public $table = 'receiver';
    public $timestamps = false;
    
    protected $fillable = [
    'from', 'to', 'text', 'date', 'gtway_id', 'LinkId'
    ];
}
