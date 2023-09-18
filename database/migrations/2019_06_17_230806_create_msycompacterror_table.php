<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsycompacterrorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msycompacterror', function (Blueprint $table) {
            $table->integer('ErrorCode')->nullable($value = true);
            $table->text('ErrorDescription')->nullable($value = true);
            $table->binary('ErrorRecid')->nullable($value = true);
            $table->string('ErrorTable')->nullable($value = true);
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
        Schema::dropIfExists('msycompacterror');
    }
}
