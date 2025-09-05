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
        Schema::create('partners', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('logo')->nullable();
    $table->string('tagline')->nullable();
    $table->text('description')->nullable();
    $table->string('website_url')->nullable();
    $table->string('country')->nullable();
    $table->enum('sponsorship_level', ['basic', 'featured', 'premium'])->default('basic');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
