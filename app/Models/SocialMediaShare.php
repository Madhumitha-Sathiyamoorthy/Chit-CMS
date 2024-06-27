<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;


class SocialMediaShare extends Model
{
    protected $connection = 'mongodb';    
    protected $collection = 'socialMediaShare';
   
    protected $fillable = ['siteUrl','title','description','image'];
}