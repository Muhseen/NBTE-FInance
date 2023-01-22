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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->integer('account_code');
            $table->decimal('projection', 20, 2)->default(0);
            $table->decimal('approved', 20, 2)->default(0);
            $table->decimal('actual', 20, 2)->default(0);
            $table->decimal('released', 20, 2)->default(0);
            $table->decimal('committed', 20, 2)->default(0);
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
        Schema::dropIfExists('budgets');
    }
};