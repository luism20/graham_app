<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Company;

use Illuminate\Http\Request;


class MindController extends Controller
{

    public function postJson($url, $fields) {
        
        // build the urlencoded data
        $payload = json_encode($fields);

        // open connection
        $ch = curl_init();

        // set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // execute post
        $result = curl_exec($ch);   
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // close connection
        curl_close($ch);


        if($http_code == 200) {
            $data = json_decode($result);
            return $data; 
        } else {
            $data = array("error"=>true, "code"=>$http_code);
            return $data;
        }
    }

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

    public function test(Request $request) {
        return $this->initCreateMindApp($request->companyId);
    }

    public function initCreateMindApp($companyId) {
        $url = env('MIND_ENGINE_BASE_URL', 'https://qlik-app-mock.herokuapp.com/');
        $url = $url . 'api/createApp';        
        
        // what post fields?
        $fields = array(           
           'companyId' => $companyId     
        );      
        
        return $this->postJson($url, $fields);
             
    }
}
