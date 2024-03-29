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
        //
        // 
        Schema::create('candidate_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('profile');
            $table->string('candidate_number');
            $table->string('candidate_name');
            $table->string('municipality');
            $table->integer('age');
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_configurations');
    }
};
