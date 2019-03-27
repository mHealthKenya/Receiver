<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KAPSInbox extends Model
{
    protected $connection = 'kaps';
    public $table = 'response';
    public $timestamps = false;
    
    protected $fillable = [
        'source','destination','response','AT_date','AT_id', 'linkid' 
    ];
}
