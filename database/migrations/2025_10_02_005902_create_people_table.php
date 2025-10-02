<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);           // Text
            $table->text('description')->nullable(); // Textarea
            $table->enum('gender', ['M','F']);     // Radio
            $table->json('hobbies')->nullable();   // Checkbox (array en JSON)
            $table->foreignId('country_id')->constrained()->cascadeOnDelete(); // Select
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('people');
    }
};
