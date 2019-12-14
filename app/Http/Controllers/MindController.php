<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Company;

use Illuminate\Http\Request;


class MindController extends Controller
{

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }

    public function mindAppCreated(Request $request) {

    	if(isset($request->companyId)) {

			$companyId = $request->companyId;
			$mainAppId = $request->mainAppId;
			$savedCompany = Company::where('id', $companyId)->first();
	        if(isset($savedCompany)) {
	            $savedCompany->mainAppId = $mainAppId;
	            $savedCompany->save();
	        }
    	}

        return response('ok', 200)->header('Content-Type', 'application/json');
    }

    public function mindAppUpdated(Request $request) {

    	return $this->mindAppCreated($request);
    }
}
