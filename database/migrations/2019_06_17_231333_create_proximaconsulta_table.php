<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProximaconsultaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proximaconsulta', function (Blueprint $table) {
            $table->increments('cdCodigo');
            $table->double('CodCli', 8, 2)->default(0);
            $table->dateTime('Data')->nullable($value = true);
            $table->integer('cdProfissional')->nullable($value = true);
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
        Schema::dropIfExists('proximaconsulta');
    }
}
