<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->uuid('id')->unique()->comment('Identificador único de cada registro');
            $table->float('amount')->default(0)->comment('Cantidad actual asignada por el contador');
            $table->dateTime('date')->nullable()->comment('Fecha asociada al contador (sirve para agrupar datos de un mismo contador por fecha)');
            $table->string('item_type', 45)->nullable()->comment('Nombre del modelo o entidad propietario del archivo');
            $table->string('item', 45)->nullable()->comment('Identificador del elemento propietario del archivo');
            $table->string('extra_name', 45)->nullable()->comment('Nombre de un campo extra para almacenar y asociar al archivo');
            $table->string('extra_data', 250)->nullable()->comment('Valor del campo extra para almacenar y asociar al archivo');
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
        Schema::dropIfExists('counters');
    }
};
