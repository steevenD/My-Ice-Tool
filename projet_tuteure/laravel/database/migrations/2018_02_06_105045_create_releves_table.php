<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelevesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('releves', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dateReleve');
            $table->time('heureReleve');
            $table->float('temperatureMoyReleve');
            $table->integer('niveauDangerReleve');


            //Foreign key
            $table->integer('zone_id')->unsigned();
            $table->foreign('zone_id')->references('id')->on('zones');

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
        Schema::dropIfExists('releves');
    }
}
