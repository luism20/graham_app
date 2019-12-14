<?php

namespace App\Http\Controllers;

use Auth;
use Redis;

use DateTime;
use DateTimeZone;
use DateInterval;

use App\Config;
use App\User;
use App\Company;
use App\Subscription;
use App\Http\Requests;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Cartalyst\Stripe\Stripe;


class HomeController extends Controller {

    public function postJson($url, $fields) {
        
        // build the urlencoded data
        $payload = json_encode($fields);

        // open connection
        $ch = curl_init();

        // set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
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
            $this->access_token =  $data->access_token;
            return $data; 
        } else {
            $data = array("error"=>true, "code"=>$http_code);
            $this->access_token = null;
            return $data;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(Auth::user()->onboarding == null && !Auth::user()->isAdmin()) {
            return view('modules/setup', [
                'title' => 'Graham Mind Setup'
            ]); 
        } else {            
            $usuarios = \App\User::all();
            return view('modules/dashboard', [
                'title' => 'Dashboard',
                "usuario" => $usuarios
            ]);  
        }
        
    }

    public function importData(Request $r){
        $config = Config::find(2019);
        if($r->onboarding == "excel"){
            $user = User::find(Auth::id());
            $user->onboarding = $r->onboarding;
            $user->save();
            return view('modules.importData', [
                'title' => 'Import Data',
                'instructions' => $config->instructions,
                'template' => $config->template
            ]);
        }else{
            return view('modules.importData', [
                'title' => 'Import Data',
                'instructions' => $config->instructions,
                'template' => $config->template
            ]);
        }

    }

    public function importDataStore(Request $request){
        $this->validate($request, [
            'file_input' => 'required|max:2048|mimes:xlsx,xls'
        ]);
        if ($request->hasFile('file_input')) {
            $file = $request->file('file_input');
            $name = time() . $file->getClientOriginalName();
            $filePath = Auth::id() . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $excelFile = Storage::url($filePath);
            $user = User::find(Auth::id());
            $user->onboarding = $excelFile;
            $userId = $user->id;
            $companyName = $user->company;
            $user->save();
            $company = $this->createCompany($userId, $companyName, $excelFile);
            $this->createDefaultSubscription($company->id);
            $this->createMindApp($company->id);
            return redirect('dashboard'); 
            /*return view('modules/dashboard', [
                'title' => "GrahamMind - Dashboard",
                "usuario" => $usuarios
            ]);*/
        }
    }

    public function createCompany($userId, $companyName, $excelFile = "") {
        $savedCompany = Company::where('userId', $userId)->where('name', $companyName)->first();
        if(isset($savedCompany)) {           
            $savedCompany->excelFile = $excelFile;
            $savedCompany->save();
            return $savedCompany;
        } else {
            $company = new Company();
            $company->userId = $userId;
            $company->name = $companyName;
            $company->excelFile = $excelFile;
            $company->save();
            return $company;
        }        
    }

    public function createDefaultSubscription($companyId) {
        $savedSubscription = Subscription::where('companyId', $companyId)->first();
        if(isset($savedSubscription)) {           
            return $savedSubscription;
        } else {
            $dt = new DateTime("now", new DateTimeZone('America/Bogota'));
            $dt->add(new DateInterval('P14D'));
            $stripDate =  $dt->format('Y-m-d');
            $subscription = new Subscription();
            $subscription->companyId = $companyId;
            $subscription->trialFinishDate = $stripDate;
            $subscription->save();
            return $subscription;
        }        
    }

    public function test(Request $request) {
        return $this->createMindApp('7');
    }

    public function createMindApp($companyId) {
        $savedCompany = Company::where('id', $companyId)->first();
        if(!isset($savedCompany->mainAppId)) {
            $this->initCreateMindApp($companyId);
        }
    }

    private function initCreateMindApp($companyId) {
        $url = env('MIND_ENGINE_BASE_URL', 'http://qlik_app_moc.herokuapp.com/');
        $url = $url . 'createApp';
        
        
        // what post fields?
        $fields = array(           
           'companyId' => $companyId     
        );      
        
        return $this->postJson($url, $fields);
             
    }

    public function leverage(){
        return \view('modules.leverage', [
            'title' => 'Leverage Analysis'
        ]);
    }

    public function asset(){
        return view('modules.asset', [
            'title' => 'Asset Analysis'
        ]);        
    }

    public function profitability(){
        return \view('modules.profitability', [
            'title' => 'Profitability Analysis'
        ]);        
    }

    public function subscriptions(){
        $stripe = Stripe::make();
        $plans = (object) $stripe->plans()->all();
        //dump($plans);
        return \view('modules.subscriptions', [
            'title' => 'Subscriptions',
            'plans' => $plans->data
        ]);        
    }

    public function subscription(){

        $user = User::find(Auth::id());
        $userId = $user->id;
        $companyName = $user->company;
        $savedCompany = Company::where('userId', $userId)->where('name', $companyName)->first();
        $companyId = $savedCompany->id;
        $savedSubscription = Subscription::where('companyId', $companyId)->first();

        $stripe = Stripe::make();
        $plans = (object) $stripe->plans()->all();

        return \view('modules.accountsubscription', [
            'title' => 'Subscription',
            'subscription' => $savedSubscription
        ]);         
    }

     /**
     * Display a listing of the configurations.
     * @return Illuminate\View\View
     */
    public function integrations() {
        return view('modules.integrations');
    }

    /**
     * Change the variable of the .env
     * @param \Illuminate\Http\Request $r
     * @return redirect
     */
    public function env(Request $r) {
        $values = $r->all();
        $setKeys = [];
        for ($i = 1; $i < count($values) / 2; $i++) {
            $setKeys[] = ['key' => $values['key' . $i], 'value' => $values['value' . $i]];
        }
        $file = DotenvEditor::setKeys($setKeys);
        DotenvEditor::save();
        return redirect('api_key');
    }

    public function configurations(){
        return \view('modules.configurations', [
            'config' => Config::find(2019),
            'title' => 'Configurations - Graham'
        ]);
    }

    public function editConfigurations(){
        return \view('modules.editConfigurations', [
            'config' => Config::find(2019),
            'title' => 'Configurations - Graham'
        ]);
    }

    public function updateConfigurations(Request $r){
        if($r->hasFile('template')){
            $this->validate($r, [
                'template' => 'mimes:xlsx,xls,csv'
            ]);
            $file = $r->file('template');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'file/' . $name;
            Storage::disk('public')->put($filePath, file_get_contents($file));
            Config::find(2019)->update([
                'template' => $name
            ]);
        }  
        
        if($r->hasFile('instructions')){
            $this->validate($r, [
                'instructions' => 'mimes:png,gif,jpg,jpeg,svg,webm,bmp'
            ]);

            $file = $r->file('instructions');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'file/' . $name;
            Storage::disk('public')->put($filePath, file_get_contents($file));
            Config::find(2019)->update([
                'instructions' => $name
            ]);
        } 
        
        return \redirect('configurations')->with('success', 'Changes successfully!');
    }

    /**
     * Moves the attached file to the server.
     *
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file) {
        if (!$file->isValid()) {
            return '';
        }
        $saved = $file->store('public', config('filesystems.default'));
        return $saved;
    }
 
}
