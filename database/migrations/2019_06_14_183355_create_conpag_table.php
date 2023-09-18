<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConpagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conpag', function (Blueprint $table) {
            $table->increments('NUMERO');
            $table->dateTime('DATA')->nullable($value = true);
            $table->dateTime('DTPAG')->nullable($value = true);
            $table->dateTime('DTVENC')->nullable($value = true);
            $table->integer('CODFOR')->default(0);
            $table->string('Nome')->nullable($value = true);
            $table->string('PAGO')->nullable($value = true);
            $table->double('VALOR')->default(0);
            $table->integer('Lanca')->default(0);
            $table->double('Valor_Pago', 19, 4)->default(0.0000);
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
        Schema::dropIfExists('conpag');
    }
}
