<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Report extends Model
{
    use SyncsWithFirebase;
    public $timestamps = false;

}
