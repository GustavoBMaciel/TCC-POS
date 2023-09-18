<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbexamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbexames', function (Blueprint $table) {
            $table->increments('cdExames');
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
        Schema::dropIfExists('tbexames');
    }
}
