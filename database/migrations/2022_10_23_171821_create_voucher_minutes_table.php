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
        Schema::create('voucher_minutes', function (Blueprint $table) {
            $table->id();
            $table->integer('voucher_id');
            $table->integer('user_id');
            $table->string('message');
            $table->json('attachments')->nullable;
            $table->integer('unit');

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
        Schema::dropIfExists('voucher_minutes');
    }
};