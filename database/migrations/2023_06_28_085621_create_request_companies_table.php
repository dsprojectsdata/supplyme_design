<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_companies', function (Blueprint $table) {
            $table->id();
            $table->string('Company_name')->nullable();
            $table->string('company_id')->nullable();
            $table->string('Website')->nullable();
            $table->string('address')->nullable();
            $table->string('P_City')->nullable();
            $table->string('P_state')->nullable();
            $table->string('P_county')->nullable();
            $table->string('P_zipcode')->nullable();
            $table->string('P_contact_number')->nullable();
            $table->string('claimed_status')->nullable();
            $table->string('company_type')->nullable();
            $table->string('company_category')->nullable();
            $table->string('company_email')->nullable();
            $table->string('Is_email_verify')->nullable();
            $table->string('status')->nullable();
            $table->string('Phone_number')->nullable();
            $table->string('deleted_at')->nullable();
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
        Schema::dropIfExists('request_companies');
    }
}
