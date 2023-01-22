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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('voucher_id')->nullable();
            $table->datetime('txn_date');
            $table->string('batch_no')->nullable();
            $table->integer('transaction_id')->nullable();
            $table->string('description')->nullable();
            $table->string('account_code');
            $table->decimal('amount', 20, 2);
            $table->string('narration')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('file_no')->nullable();
            $table->integer('funding_account');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};