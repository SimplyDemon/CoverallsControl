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
        Schema::create('contract_coverall_type', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\CoverallType::class)->constrained();
            $table->foreignIdFor(\App\Models\Contract::class)->constrained();
            $table->integer('quantity_planned');
            $table->integer('quantity_received')->default(0);
            $table->integer('size');
            $table->enum('status', ['pending', 'particular', 'finished', 'canceled'])->default('pending');
            $table->primary(['contract_id', 'coverall_type_id', 'size']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_coverall_type');
    }
};
