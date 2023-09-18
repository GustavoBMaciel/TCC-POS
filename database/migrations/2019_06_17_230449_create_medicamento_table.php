<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamento', function (Blueprint $table) {
            $table->increments('codigo');
            $table->string('nomeGenerico')->nullable($value = true);
            $table->string('nomeFabrica')->nullable($value = true);
            $table->string('fabricante')->nullable($value = true);
            $table->string('concentracao')->nullable($value = true);
            $table->string('administracao')->nullable($value = true);
            $table->string('posologia')->nullable($value = true);
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
        Schema::dropIfExists('medicamento');
    }
}
