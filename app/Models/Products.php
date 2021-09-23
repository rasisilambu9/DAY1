<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $hidden = ['created_at','updated_at','approve_status','qrcode'];
    
    public function getImages(){

        return $this->hasOne("App\Models\ProdImage",'id');

    }

    public function getVideos(){

        return $this->hasOne("App\Models\Video",'id');

    }
}
