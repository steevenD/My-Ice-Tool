<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCascadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cascades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomCascade');
            $table->integer('nbVoiesCascades');
            $table->double('altiMiniCascade',15,8);
            $table->double('hauteurCascade',15,8);
            $table->string('niveauDifCascade');
            $table->string('niveauEngCascade');
            $table->string('orientCascade');
            $table->double('longCascade',15,8);
            $table->double('latCascade',15,8);

            //Foreign key
            $table->integer('structure_id')->unsigned();
            $table->foreign('structure_id')->references('id')->on('structures');

            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('type_glaces');

            $table->integer('typeFin_id')->unsigned();
            $table->foreign('typeFin_id')->references('id')->on('type_fin_vies');
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
        Schema::dropIfExists('cascades');
    }
}
