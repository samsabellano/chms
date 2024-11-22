<?php

use App\Enums\CivilStatus;
use App\Enums\Gender;
use App\Enums\Suffix;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('occupation_id')->nullable()->constrained('occupations')->nullOnDelete();
            $table->foreignId('workplace_id')->nullable()->constrained('workplaces')->nullOnDelete();
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->enum('suffix', Suffix::toArray())->nullable();
            $table->string('photo')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('age')->default(0)->nullable();
            $table->enum('civil_status', CivilStatus::toArray());
            $table->enum('gender', Gender::toArray());
            $table->string('contact_number', 11)->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
