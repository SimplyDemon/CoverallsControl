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
            $table->foreignIdFor(\App\Models\CoverallType::class)->constrained();
            $table->foreignIdFor(\App\Models\Position::class)->constrained();
            $table->integer('quantity')->default(1);
            $table->primary(['position_id', 'coverall_type_id']);
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
