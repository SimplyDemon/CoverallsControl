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
        Schema::create('coveralls', function (Blueprint $table) {
            $table->id();
            $table->integer('coverall_type_id');
            $table->foreign('coverall_type_id')->references('id')->on('coverall_types')->onDelete('cascade');
            $table->integer('size');
            $table->enum('status', ['defective', 'issued', 'in_stock', 'returned', 'ready_for_disposal', 'disposed']);
            $table->timestamp('date_issuance')->nullable();
            $table->timestamp('date_replacement')->nullable();
            $table->integer('contract_id');
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coveralls');
    }
};
