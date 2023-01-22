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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->date('txn_date');
            $table->string('bank');
            $table->string('bank_branch');
            $table->string('pv_no');
            $table->string('account_no');
            $table->string('payee');
            $table->string('account_code');
            $table->string('description')->nullable();
            $table->decimal('amount', 14, 2);
            $table->string('narration')->nullable();
            $table->string('prepared_by')->nullable();
            $table->date('prepared_date')->nullable();
            $table->string('checked_by')->nullable();
            $table->date('checked_date')->nullable();
            $table->string('approved_by')->nullable();
            $table->date('approved_date')->nullable();
            $table->string('certified_by')->nullable();
            $table->date('certified_date')->nullable();
            $table->string('schedule_no')->nullable();
            $table->string('status')->default('pending');
            $table->string('location')->default('EC');
            $table->text('detailed_description');
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
        Schema::dropIfExists('vouchers');
    }
};