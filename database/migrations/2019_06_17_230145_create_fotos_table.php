<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->increments('codigo');
            $table->integer('codcliente')->nullable($value = true);
            $table->string('localFoto1')->nullable($value = true);
            $table->text('obsFoto1')->nullable($value = true);
            $table->string('localFoto2')->nullable($value = true);
            $table->text('obsFoto2')->nullable($value = true);
            $table->string('localFoto3')->nullable($value = true);
            $table->text('obsFoto3')->nullable($value = true);
            $table->string('localFoto4')->nullable($value = true);
            $table->text('obsFoto4')->nullable($value = true);
            $table->string('localFoto5')->nullable($value = true);
            $table->text('obsFoto5')->nullable($value = true);
            $table->string('localFoto6')->nullable($value = true);
            $table->text('obsFoto6')->nullable($value = true);
            $table->string('localFoto7')->nullable($value = true);
            $table->text('obsFoto7')->nullable($value = true);
            $table->string('localFoto8')->nullable($value = true);
            $table->text('obsFoto8')->nullable($value = true);
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
        Schema::dropIfExists('fotos');
    }
}
