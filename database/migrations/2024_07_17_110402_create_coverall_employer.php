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
        Schema::create('coverall_employer', function (Blueprint $table) {
            $table->bigInteger('coverall_id')->unsigned();
            $table->bigInteger('employer_id')->unsigned();
            $table->foreign('coverall_id')->references('id')->on('coveralls')->onDelete('cascade');
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coverall_employer');
    }
};
