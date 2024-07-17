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
            $table->bigInteger('coverall_type_id')->unsigned();
            $table->bigInteger('contract_id')->unsigned();
            $table->foreign('coverall_type_id')->references('id')->on('coverall_types')->onDelete('cascade');
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->integer('count_planned');
            $table->integer('count_received');
            $table->integer('size');
            $table->enum('status', ['pending', 'particular', 'finished', 'canceled']);
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
