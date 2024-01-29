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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->longText('message')->nullable();
            $table->string('type')->nullable();
            $table->longText('context')->nullable();
            $table->string('level')->nullable();
            $table->string('environment')->nullable();
            $table->string('app_url')->nullable();
            $table->string('file')->nullable();
            $table->string('line')->nullable();
            $table->longText('request')->nullable();
            $table->boolean('sloved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
