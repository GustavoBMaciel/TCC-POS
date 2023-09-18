<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmb92Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amb92', function (Blueprint $table) {
            $table->string('codigo')->nullable($value = true);
            $table->string('descricao')->nullable($value = true);
            $table->double('ch')->nullable($value = true);
            $table->double('numeroAux')->nullable($value = true);
            $table->double('porteAnestesico')->nullable($value = true);
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
        Schema::dropIfExists('amb92');
    }
}
