<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('FirstName')->nullable();
            $table->string('MiddleName')->nullable();
            $table->string('LastName')->nullable();
            $table->string('WebsiteSite')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('privallageId')->nullable();
            $table->string('JobRole')->nullable();
            $table->string('Dicipline')->nullable();
            $table->string('JobLevel')->nullable();
            $table->string('addressLine_1')->nullable();
            $table->string('City')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('about_us')->nullable();
            $table->string('Primary_Use_our_network_for')->nullable();
            $table->string('img_path')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
