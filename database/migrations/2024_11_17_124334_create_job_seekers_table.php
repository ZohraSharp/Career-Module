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
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email', 250)->unique();
            $table->string('phone_number', 20);
            $table->text('address')->nullable();
            $table->date('dob');
            $table->integer('experience_years')->default(0);
            $table->text('skills')->nullable();
            $table->text('training_certifications')->nullable();
            $table->string('referredBy');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_seekers');
    }
};
