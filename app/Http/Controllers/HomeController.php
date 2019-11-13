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

class HomeController extends Controller {

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
        $usuarios = \App\User::all();
        return view('modules/dashboard', [
            'title' => 'Dashboard',
            "usuario" => $usuarios
        ]);
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
            return ['message' => 'File uploaded successfully'];
        }
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
