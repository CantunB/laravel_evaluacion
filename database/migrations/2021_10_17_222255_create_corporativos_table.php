<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tw_corporativos', function (Blueprint $table) {
            $table->id();
            $table->string('S_NombreCorto',45);
            $table->string('S_NombreCompleto', 75);
            $table->string('S_LogoURL', 255)->nullable();
            $table->string('S_DBName',45);
            $table->string('S_DBUsuario',45);
            $table->string('S_DBPassword',150);
            $table->string('S_SystemUrl',255);
            $table->tinyInteger('S_Activo')->default(1)->change();;
            $table->timestamp('D_FechaIncorporacion');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('tw_usuarios_id');
            $table->unsignedBigInteger('FK_Asignado_id');


            $table->foreign('tw_usuarios_id')->references('id')->on('tw_usuarios');
            $table->foreign('FK_Asignado_id')->references('id')->on('tw_usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tw_corporativos');
    }
}
