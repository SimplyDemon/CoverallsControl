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
            $table->foreignIdFor(\App\Models\CoverallType::class)->constrained();
            $table->foreignIdFor(\App\Models\Employer::class)->nullable()->constrained();
            $table->foreignIdFor(\App\Models\Contract::class)->constrained();
            $table->integer('size');
            $table->enum('status', ['defective', 'issued', 'in_stock', 'returned', 'ready_for_disposal', 'disposed']);
            $table->timestamp('date_issuance')->nullable();
            $table->timestamp('date_replacement')->nullable();
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
