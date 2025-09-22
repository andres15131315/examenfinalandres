<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');

            $table->dateTime('fecha');
            $table->dateTime('fecha_fin')->nullable();

            $table->text('nota')->nullable();
            $table->string('texto', 200)->nullable();
            $table->string('descripcion_cancel', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
