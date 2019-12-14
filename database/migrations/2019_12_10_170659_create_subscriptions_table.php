<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('companyId',100);
            $table->dateTime('trialStartDate')->useCurrent();
            $table->dateTime('trialFinishDate')->nullable(true);
            $table->dateTime('startDate')->nullable(true);
            $table->dateTime('finishDate')->nullable(true);
            $table->string('name',100);
            $table->boolean('billedMonthly')->default(true);
            $table->boolean('billedAnnually')->default(false);
            $table->string('paymentMethod',100);
            $table->string('status',100)->default('active');
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
        Schema::dropIfExists('subscriptions');
    }
}
