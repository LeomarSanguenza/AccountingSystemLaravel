<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('disbursement_details', function (Blueprint $table) {
            $table->id('dv_detail_id');
            $table->unsignedBigInteger('dv_hdr_id'); // foreign key
            $table->string('account_codes')->nullable();
            $table->string('sub_account')->nullable();
            $table->string('fpp')->nullable();
            $table->string('fpp_category')->nullable();
            $table->decimal('debit', 15, 2)->default(0);
            $table->decimal('credit', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();

            // foreign key constraint
            $table->foreign('dv_hdr_id')->references('dv_hdr_id')->on('disbursement_headers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disbursement_details');
    }
};
