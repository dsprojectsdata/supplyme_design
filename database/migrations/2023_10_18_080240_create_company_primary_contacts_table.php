<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPrimaryContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_primary_contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('contact_no')->nullable();
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
        Schema::dropIfExists('company_primary_contacts');
    }
}
