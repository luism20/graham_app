<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
    	'userId',
	    'name',
	    'access_token',
	    'refresh_token',
	    'expires_in',
	    'x_refresh_token_expires_in',
	    'realmId',
	    'mainAppId'
	  ]; 
}
