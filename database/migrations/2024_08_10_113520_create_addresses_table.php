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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->string('address_line_1', 100)->comment('House No./Bldg./Street');
            $table->string('address_line_2', 100)->nullable();
            $table->string('barangay', 50);
            $table->string('city_or_municipality', 50);
            $table->string('state_or_province', 50);
            $table->string('country', 50);
            $table->string('postal_code', 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
