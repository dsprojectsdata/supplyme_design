<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfqAdditionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfq_additionals', function (Blueprint $table) {
            $table->id();
            $table->string('additional_file')->nullable();
            $table->string('additional_name')->nullable();
            $table->string('additional_information')->nullable();
            $table->string('rfqdetail_id')->nullable();
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
        Schema::dropIfExists('rfq_additionals');
    }
}
