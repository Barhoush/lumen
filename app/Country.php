<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Country extends Model
{
	protected $table    =   'country';
	protected $guarded  =   [];
	public $timestamps  =   false;
	function cities(){
		return  $this->hasMany('App\City',  'countryId');
	}

	public function addresses()
	{
		return $this->hasManyThrough('App\Address', 'App\City');
	}
}
