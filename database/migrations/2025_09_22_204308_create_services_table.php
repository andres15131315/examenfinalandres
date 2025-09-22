<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('abbreviation', 10); 
            $table->string('nombre', 100);
            $table->text('description')->nullable();
            $table->decimal('precio', 10, 2); 
            $table->integer('estimated_time')->nullable();

            // Relaciones
            $table->foreignId('business_id')->constrained()->onDelete('cascade');
            $table->foreignId('status_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
