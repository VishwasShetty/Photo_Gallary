<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Photo;
class Album extends Model
{
    protected $fillable=array('name','discription','cover_image');
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
