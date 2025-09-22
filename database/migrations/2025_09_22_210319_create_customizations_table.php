<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customizations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');

            $table->string('nombre', 100)->nullable();
            $table->string('eslogan', 200)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('color_secundario', 20)->nullable();
            $table->string('color_fondo', 20)->nullable();
            $table->string('color_texto', 20)->nullable();
            $table->string('logo_p', 500)->nullable();
            $table->string('logo_p2', 500)->nullable();
            $table->string('favicon', 500)->nullable();
            $table->integer('duracion_min')->default(30);
            $table->integer('anticipacion_min')->default(15);
            $table->time('horario_atencion_ini')->nullable();
            $table->time('horario_atencion_fin')->nullable();
            $table->string('dias_atencion', 50)->nullable();
            $table->integer('maximo_citas')->default(1);
            $table->string('titulo', 200)->nullable();
            $table->string('subtitulo', 200)->nullable();
            $table->text('mensaje_bienvenida')->nullable();
            $table->text('mensaje_confirmacion')->nullable();
            $table->text('texto_pie')->nullable();
            $table->string('facebook', 200)->nullable();
            $table->string('instagram', 200)->nullable();
            $table->string('whatsapp', 200)->nullable();
            $table->boolean('mostrar_fecha')->default(true);
            $table->boolean('acepta_efectivo')->default(true);
            $table->boolean('acepta_tarjeta')->default(false);
            $table->boolean('acepta_transferencia')->default(false);
            $table->boolean('mostrar_precios')->default(true);
            $table->boolean('require_confirmacion')->default(false);
            $table->boolean('permite_cancelar')->default(true);
            $table->integer('horas_limite')->default(24);
            $table->text('configuracion_extra')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customizations');
    }
};
