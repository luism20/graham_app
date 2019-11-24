<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use App\Company;
use App\GrahamUser;
use App\CompanyAppLog;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = GrahamUser::find($id);
       return view('companies.create', compact('user'));
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $userId = Auth::id();
        $company = new Company([
        'userId' => $userId,
        'name' => $request->get('name')
        ]);
        $company->save();
        return view('modules.setup', [
            'title' => 'Integrations',
            'company' => $company
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        return view('companies.detail', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {          

          $request->validate([            
            'name'=> 'required',
          ]);

          $company = Company::find($id);
          $company->name = $request->get('name');
          $company->save();

          return redirect('/companies')->with('success', 'Company has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $user = Company::find($id);
         $user->delete();

         return redirect('/companies')->with('success', 'Company has been deleted Successfully');
    }

    public function addLog(Request $request) {
    //public function addLog($companyId, $appId, $message, $userId="") {

        $json = json_decode($request->getContent());
        
        $companyLog = new CompanyAppLog([
        'companyId' => $json->companyId,
        'mainAppId' => $json->mainAppId,
        'log' => $json->log,
        'userId' => $json->userId
        ]);
        
        $companyLog->save();
        $return = array("id"=>$companyLog->id);
        return $return;
    }
}
