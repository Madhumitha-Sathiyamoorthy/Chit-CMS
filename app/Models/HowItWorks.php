<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;


class HowItWorks extends Model
{
    protected $connection = 'mongodb';    
    protected $collection = 'howItWorks';
}
