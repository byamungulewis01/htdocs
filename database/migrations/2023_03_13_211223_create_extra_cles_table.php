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
        Schema::create('extra_cles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('closing_date');
            $table->string('category');
            $table->integer('hours');
            $table->decimal('credits');
            $table->UnsignedBigInteger('advocate');
            $table->integer('yearInBar');
            $table->foreign('advocate')->references('id')->on('users')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('extra_cles');
    }
};
