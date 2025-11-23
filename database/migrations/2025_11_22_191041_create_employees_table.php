<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('job_position_id')->nullable()->constrained()->nullOnDelete();

        $table->string('employee_code')->unique();

        $table->string('first_name');
        $table->string('last_name');
        $table->string('other_names')->nullable();

        $table->enum('gender', ['male', 'female', 'other'])->nullable();
        $table->date('date_of_birth')->nullable();

        $table->date('hire_date')->nullable();
        $table->enum('employment_type', ['full_time', 'part_time', 'contract', 'intern'])->default('full_time');
        $table->enum('status', ['active', 'on_leave', 'terminated', 'suspended'])->default('active');

        $table->string('phone')->nullable();
        $table->string('alt_phone')->nullable();
        $table->string('email')->nullable();
        $table->string('address')->nullable();
        $table->string('city')->nullable();
        $table->string('state')->nullable();
        $table->string('country')->nullable();

        $table->decimal('base_salary', 12, 2)->nullable();
        $table->string('currency', 3)->default('NGN');

        $table->json('meta')->nullable(); // for future extra fields

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
