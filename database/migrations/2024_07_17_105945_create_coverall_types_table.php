<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coverall_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('img');
            $table->enum('type', ['gloves', 'boots', 'helmet', 'robe', 'other']);
            $table->integer('term_life'); // In month
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coverall_types');
    }
};
