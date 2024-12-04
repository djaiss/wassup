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
        Schema::create('checkins', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('cycle_id')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->longText('content');
            $table->timestamps();
            $table->foreign('cycle_id')->references('id')->on('cycles')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkins');
    }
};
