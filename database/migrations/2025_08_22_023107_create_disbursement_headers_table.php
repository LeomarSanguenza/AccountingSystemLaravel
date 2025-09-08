<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('disbursement_headers', function (Blueprint $table) {
            $table->id('dv_hdr_id'); 
            $table->date('date_of_voucher')->nullable();
            $table->string('mode_of_payment')->nullable();
            $table->string('fund_type')->nullable();
            $table->string('dv_number')->nullable(); // disbursement voucher number
            $table->string('obligation_number')->nullable();
            $table->string('responsibility_center')->nullable();
            $table->string('fpp')->nullable();
            $table->string('payee')->nullable();
            $table->string('tin')->nullable();
            $table->string('address')->nullable();
            $table->date('date_of_check')->nullable();
            $table->string('bank')->nullable();
            $table->string('check_number')->nullable();
            $table->decimal('check_amount', 15, 2)->default(0);
            $table->date('date_of_or')->nullable(); // OR date
            $table->string('or_document')->nullable(); // OR / Other Document
            $table->string('jev_no')->nullable();
            $table->text('particulars')->nullable();
            $table->string('status')->default('pending');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disbursement_headers');
    }
};
