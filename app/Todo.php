<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
	public function user(){
		return $this->belongTo('App/User', 'uid');
	}
}
