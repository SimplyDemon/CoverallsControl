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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('name_first', 50);
            $table->string('name_last', 50);
            $table->string('name_middle', 50)->nullable();
            $table->string('certificate_id')->unique();
            $table->foreignIdFor(\App\Models\Position::class)->constrained();
            $table->timestamp('date_of_birth');
            $table->string('phone');
            $table->string('address_documental');
            $table->string('address_actual')->nullable();
            $table->integer('size_head');
            $table->integer('size_body');
            $table->integer('size_foot');
            $table->integer('size_face');
            $table->integer('size_gloves');
            $table->integer('height');
            $table->enum('status', ['active', 'inactive', 'fired',])->default('active');
            $table->string('img');
            $table->foreignIdFor(\App\Models\Division::class)->nullable()->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
