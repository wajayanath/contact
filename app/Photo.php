<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'contact_photos';

     protected $fillable = ['path'];

    public function contact()
    {
    	$this->belongsTo('App\Contact');
    }
}
