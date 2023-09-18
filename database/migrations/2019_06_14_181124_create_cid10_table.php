<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCid10Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cid10', function (Blueprint $table) {
            $table->string('CID10')->nullable($value = true);
            $table->string('OPC')->nullable($value = true);
            $table->string('CAT')->nullable($value = true);
            $table->string('SUBCAT')->nullable($value = true);
            $table->string('DESCR')->nullable($value = true);
            $table->string('RESTRSEXO')->nullable($value = true);
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
        Schema::dropIfExists('cid10');
    }
}
