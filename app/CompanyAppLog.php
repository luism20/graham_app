<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAppLog extends Model
{
    //
    protected $fillable = [
	    'companyId',
	    'mainAppId',
	    'log',
	    'userId'
	  ];  
}
