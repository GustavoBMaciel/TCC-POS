<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbmedicamentositensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbmedicamentositens', function (Blueprint $table) {
            $table->increments('cdMedicamentosItens');
            $table->integer('codMedicamentos')->nullable($value = true);
            $table->integer('codMedicamento')->nullable($value = true);
            $table->string('concentracao')->nullable($value = true);
            $table->string('administracao')->nullable($value = true);
            $table->string('posologia')->nullable($value = true);
            $table->string('qtde')->nullable($value = true);
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
        Schema::dropIfExists('tbmedicamentositens');
    }
}
