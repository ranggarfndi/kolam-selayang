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
        Schema::create('pools', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: 'Kolam Atas'
            $table->string('depth_info')->nullable(); // Contoh: '1.8m - 5.2m'
            $table->enum('status', ['Buka', 'Pembersihan', 'Tutup'])->default('Tutup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pools');
    }
};
