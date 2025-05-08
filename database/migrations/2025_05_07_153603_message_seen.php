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
        Schema::create('seens', function (Blueprint $table) {
            $table->foreignId('message_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamp('seen_at')->useCurrent();
            $table->primary(['message_id', 'user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
