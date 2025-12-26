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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model')->nullable();
            $table->string('serial_number')->unique()->nullable();
            $table->string('category');
            $table->enum('status', ['operational', 'in_repair', 'maintenance', 'retired'])->default('operational');
            $table->date('purchase_date')->nullable();
            $table->date('last_maintenance_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
