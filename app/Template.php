<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
    	'name',
    	'nb_of_images',
    	'nb_of_texts'
    ];

}
