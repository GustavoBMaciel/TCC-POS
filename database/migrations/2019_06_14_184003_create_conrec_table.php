<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConrecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conrec', function (Blueprint $table) {
            $table->increments('NUMERO');
            $table->dateTime('DATA')->nullable($value = true);
            $table->dateTime('DTPAG')->nullable($value = true);
            $table->dateTime('DTVENC')->nullable($value = true);
            $table->integer('LANCA')->default(0);
            $table->double('VALOR', 19, 4)->nullable($value = true);
            $table->string('PAGO')->nullable($value = true);
            $table->integer('CLIENTE')->default(0);
            $table->string('Nome')->nullable($value = true);
            $table->tinyInteger('VL')->nullable($value = true);
            $table->double('Valor_Pago', 19, 4)->default(0.0000);
            $table->tinyInteger('Sn')->nullable($value = true);
            $table->string('cond')->nullable($value = true);
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
        Schema::dropIfExists('conrec');
    }
}
