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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('image', 255)->nullable();
            $table->string('title')->nullable();
            $table->string('author');
            $table->unsignedBigInteger('pustakawan');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pustakawan')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
