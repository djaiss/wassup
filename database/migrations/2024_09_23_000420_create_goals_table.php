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
        Schema::create('goals', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('cycle_id')->nullable();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->foreign('cycle_id')->references('id')->on('cycles')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
