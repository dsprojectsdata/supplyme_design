<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSingBidSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sing_bid_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('rfqdetail_id')->nullable();
            $table->string('company_id')->nullable(); 
            $table->string('bid_sign_file')->nullable();
            $table->string('bid_sign_name')->nullable();
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
        Schema::dropIfExists('sing_bid_sheets');
    }
}
