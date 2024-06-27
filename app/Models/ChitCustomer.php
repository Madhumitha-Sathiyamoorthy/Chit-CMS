<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;


class ChitCustomer extends Model
{
    protected $connection = 'mongodb';    
    protected $collection = 'chitCustomer';
    protected $fillable = ['name','email','mobile','kycNumber','salary','chits','cutomerId','eligibility','isActive','chitImage','galleryImages'];
    
}
