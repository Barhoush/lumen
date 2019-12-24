<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class City extends Model
{
	protected $table    =   'city';
	protected $guarded  =   [];
	public $timestamps  =   false;
	public function country(){
		return  $this->belongsTo('App\Country', 'countryId');
	}

	public function addresses(){
		return  $this->hasMany('App\Address',   'cityId');
	}
}
