<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //
    protected $fillable = [    	
	    'companyId',
	    'trialStartDate',
	    'trialFinishDate',
	    'startDate',
	    'finishDate',
	    'name',
	    'billedMonthly',
	    'billedAnnually',
	    'paymentMethod',
	    'status'
	  ];
}
