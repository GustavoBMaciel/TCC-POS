<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbmedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbmedicamentos', function (Blueprint $table) {
            $table->increments('cdMedicamentos');
            $table->integer('codCliente')->nullable($value = true);
            $table->dateTime('data')->nullable($value = true);
            $table->text('obs')->nullable($value = true);
            $table->string('usuario')->nullable($value = true);
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
        Schema::dropIfExists('tbmedicamentos');
    }
}
