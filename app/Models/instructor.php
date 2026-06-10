<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class instructor extends Model
{
   use HasFactory;

   protected $fillable = ['name', 'img', 'designation', 'facebook_link', 'twitter_link', 'instagram_link', 'status'];
}
