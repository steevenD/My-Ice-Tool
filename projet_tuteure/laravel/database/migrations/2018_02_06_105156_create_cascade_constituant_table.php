<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCascadeConstituantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cascade_constituant', function (Blueprint $table) {
            $table->float('poids')->nullable();

            $table->integer('cascade_id')->unsigned();
            $table->foreign('cascade_id')->references('id')->on('cascades');

            $table->integer('constituant_id')->unsigned();
            $table->foreign('constituant_id')->references('id')->on('constituants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cascades_constituants');
    }
}
