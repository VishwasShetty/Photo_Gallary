<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Album;
class Photo extends Model
{
   protected $fillable=array('album_id','discription','photo','title','size');
   public function album()
   {
       return $this->belongsTo('App\Album');
   }
}
