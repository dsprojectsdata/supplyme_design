<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySubscriptionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_subscription_histories', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('plan_id')->nullable();
            $table->string('plan_duration')->nullable();
            $table->string('plan_name')->nullable();
            $table->string('plan_price')->nullable();
            $table->string('subscription_date')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_gateway_name')->nullable();
            $table->string('payment_gateway_status')->nullable();
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
        Schema::dropIfExists('company_subscription_histories');
    }
}
