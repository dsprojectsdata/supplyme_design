<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('identifier', 55);
            $table->string('display_name')->nullable();
            $table->unsignedInteger('rfq_id', false)->nullable();
            $table->unsignedInteger('ccg_id', false)->nullable();
            $table->unsignedInteger('supplier_id', false)->nullable();
            $table->unsignedInteger('partner_id', false)->nullable();
            $table->unsignedInteger('partner_id_1', false)->nullable();
            $table->string('partner_name', 111)->nullable();
            $table->string('partner_name_1', 111)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
