<?php

namespace App\Http\Controllers;

use App\Config;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Redis;

class IntegrationController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //TODO: Remove comment
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        return view('modules/setup', [
            'title' => 'Integrations'
        ]);
    }

    public function excel() {
        
        return view('modules/excel', [
            'title' => 'Integrations'
        ]);
    }

    public function company() {
        
        return view('modules/company', [
            'title' => 'Add a company'
        ]);
    }

    public function addCompany() {
        
        return view('modules/company', [
            'title' => 'Add a company'
        ]);
    }

    public function callbackAppCreated(Request $request) {
        $companyId = $request->get('workerId');
    } 

}
