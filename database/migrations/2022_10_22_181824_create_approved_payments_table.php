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
        Schema::create('approved_payments', function (Blueprint $table) {
            $table->id();
            $table->date('approval_date');
            $table->decimal('amount', 12, 2);
            $table->string('description')->nullable();
            $table->string('beneficiary');
            $table->integer('status')->default(-1); //unprocessed
            $table->integer('voucher_id')->nullable(); //unprocessed
            $table->json('attachments')->nullable();
            $table->integer('assign_to')->nullable();
            $table->string('type')->default('contract');
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
        Schema::dropIfExists('approved_payments');
    }
};