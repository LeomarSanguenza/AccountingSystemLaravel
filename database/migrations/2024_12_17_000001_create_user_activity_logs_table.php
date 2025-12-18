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
        Schema::create('user_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('action'); // 'page_visit', 'create', 'update', 'delete', 'view', 'login', 'logout'
            $table->string('module'); // 'disbursements', 'journals', 'users', 'tools', etc.
            $table->string('description'); // Human readable description
            $table->string('url'); // The URL accessed
            $table->string('method')->default('GET'); // HTTP method
            $table->json('data')->nullable(); // Additional data (form data, IDs, etc.)
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at');
            
            $table->index(['user_id', 'created_at']);
            $table->index(['module', 'action']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activity_logs');
    }
};