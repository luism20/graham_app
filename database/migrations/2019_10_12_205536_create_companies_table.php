<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userId');
            $table->string('name',500)->default('');
            $table->string('excelFile',600)->default(''); 
            $table->string('access_token',1000)->default('');   
            $table->string('refresh_token',1000)->default(''); 
            $table->dateTime('expires_in')->useCurrent();       
            $table->dateTime('x_refresh_token_expires_in')->useCurrent();  
            $table->string('realmId',1000)->default(''); 
            $table->string('mainAppId',500)->default(''); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
