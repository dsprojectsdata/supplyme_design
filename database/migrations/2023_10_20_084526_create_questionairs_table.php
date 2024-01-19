<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionairs', function (Blueprint $table) {
            $table->id();
            $table->string('rfqdetail_id')->nullable();
            $table->string('form_name')->nullable(); 
            $table->string('description')->nullable();
            $table->string('questiona')->nullable();
            $table->string('answer_type')->nullable();
            $table->string('option_name')->nullable();
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
        Schema::dropIfExists('questionairs');
    }
}
