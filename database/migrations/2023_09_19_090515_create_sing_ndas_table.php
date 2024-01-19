<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSingNdasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sing_ndas', function (Blueprint $table) {
            $table->id();
            $table->string('rfqdetail_id')->nullable();
            $table->string('company_id')->nullable(); 
            $table->string('nda_sign_file')->nullable();
            $table->string('nda_sign_name')->nullable();
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
        Schema::dropIfExists('sing_ndas');
    }
}
