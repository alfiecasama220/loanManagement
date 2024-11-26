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
        Schema::create('borrowers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 100);
            $table->string('middlename', 100);
            $table->string('lastname', 100);
            $table->text('address');
            $table->string('sex', 50);
            $table->string('age', 100);
            $table->string('civil', 100);
            $table->string('religion', 100);
            $table->string('contact_no', 30);
            $table->string('dateOfBirth', 100);
            $table->string('placeOfBirth', 100);
            $table->string('yearLevel', 50);
            $table->string('course', 100);
            $table->string('email', 50);
            $table->string('username', 50);
            $table->string('password', 100);
            $table->string('tax_id', 50)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowers');
    }
};
