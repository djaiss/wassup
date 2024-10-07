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
        Schema::create('goal_member', function (Blueprint $table): void {
            $table->unsignedBigInteger('goal_id');
            $table->unsignedBigInteger('member_id');
            $table->timestamps();
            $table->foreign('goal_id')->references('id')->on('goals')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal_user');
    }
};
