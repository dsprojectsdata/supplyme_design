<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcgFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ccg_feeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_collaborator_group_id')->nullable();
            $table->longText('description');
            $table->foreignId('user_id');
            $table->foreignId('company_id')->nullable();
            $table->string('primary_image')->nullable();
            $table->json('images');
            $table->string('video')->nullable();
            $table->integer('like_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->integer('share_count')->default(0);
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
        Schema::dropIfExists('ccg_feeds');
    }
}
