<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('txn_date');
            $table->string('description')->nullable();
            $table->decimal('amount_cr', 20, 2)->default(0);
            $table->string('receipt_no')->nullable();
            $table->string('account_code_cr')->nullable();
            $table->string('payer')->nullable();
            $table->decimal('amount_db', 20, 2)->default(0);
            $table->string('voucher_no');
            $table->integer('voucher_id');
            $table->string('account_code_db')->nullable();
            $table->string('payee')->nullable();
            $table->uuid('transaction_id')->nullable();
            $table->string('prepared_by')->nullable();
            $table->string('confirmed_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('narration')->nullable();
            $table->string('month');
            $table->string('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};