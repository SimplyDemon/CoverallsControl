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
            $table->foreignIdFor(\App\Models\Coverall::class)->unique()->constrained();
            $table->foreignIdFor(\App\Models\Employer::class)->constrained();
            $table->primary(['employer_id', 'coverall_id']);
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
