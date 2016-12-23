<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $fillable = [
		'template_id',
		'name',
		'slug',
		'title',
		'meta_description',
		'is_visible',
		'parent_id'
	];
}
