<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCascadeSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cascade_support', function (Blueprint $table) {
            $table->integer('cascade_id')->unsigned();
            $table->foreign('cascade_id')->references('id')->on('cascades');

            $table->integer('support_id')->unsigned();
            $table->foreign('support_id')->references('id')->on('supports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cascades_support');
    }
}
