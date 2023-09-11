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
        Schema::create('compliances', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->decimal('cle_credits')->default(0.00);
            $table->decimal('meeting_credits')->default(0.00);
            $table->decimal('extra_credits')->default(0.00);
            $table->decimal('total_credits')->default(0.00);
            $table->UnsignedBigInteger('user_id');
            $table->UnsignedBigInteger('created_by');
            $table->UnsignedBigInteger('update_by');
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('admins')->constrained()->onDelete('cascade');
            $table->foreign('update_by')->references('id')->on('admins')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('compliances');
    }
};
