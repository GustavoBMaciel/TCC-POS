<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbconfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbconfig', function (Blueprint $table) {
            $table->increments('cdConfig');
            $table->string('dsNomeMedico')->nullable($value = true);
            $table->string('dsCRM')->nullable($value = true);
            $table->string('dsCPF')->nullable($value = true);
            $table->string('dsEspecialidade')->nullable($value = true);
            $table->string('dsFone')->nullable($value = true);
            $table->string('dsCelular')->nullable($value = true);
            $table->string('dsAnamnese1')->nullable($value = true);
            $table->string('dsAnamnese2')->nullable($value = true);
            $table->string('dsCaminhoRel')->nullable($value = true);
            $table->string('dsTamanhoFonte')->nullable($value = true);
            $table->string('FontePadrao')->nullable($value = true);
            $table->integer('dsExamePularLinhaInicio')->nullable($value = true);
            $table->integer('dsExamePularLinhaFinal')->nullable($value = true);
            $table->integer('dsReceituarioPularLinhaInicio')->nullable($value = true);
            $table->integer('dsReceituarioPularLinhaFinal')->nullable($value = true);
            $table->integer('dsQtdeColunas')->nullable($value = true);
            $table->string('dsImprimirDatasReceituario')->nullable($value = true);
            $table->integer('nuTimerAgenda')->nullable($value = true);
            $table->integer('cdProfissional')->nullable($value = true);
            $table->integer('receituarioMargemEsquerda')->nullable($value = true);
            $table->string('dsPedeFinanceiroAgenda')->default('S');
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
        Schema::dropIfExists('tbconfig');
    }
}
