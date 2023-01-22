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
        Schema::create('npa_retirements', function (Blueprint $table) {
            $table->id();
            $table->integer('npa_id');
            $table->string('account_code');
            $table->decimal('amount', 12, 2);
            $table->string('narration')->nullable();
            $table->string('description')->nullable();
            $table->date('rt_date');
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
        Schema::drop('npa_retirements');
    }
};