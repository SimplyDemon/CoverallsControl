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
        Schema::create('coverall_type_position', function (Blueprint $table) {
            $table->bigInteger('coverall_type_id')->unsigned();
            $table->bigInteger('position_id')->unsigned();
            $table->foreign('coverall_type_id')->references('id')->on('coverall_types')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coverall_type_position');
    }
};
