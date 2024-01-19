<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->tinyInteger('status')->comment("0=rejectd, 1=approve, 2=pending")->default(2);
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('companies');
            $table->foreign('group_id')->references('id')->on('company_collaborators_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_suppliers');
    }
}
