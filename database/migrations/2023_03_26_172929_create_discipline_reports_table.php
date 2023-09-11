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
        Schema::create('discipline_reports', function (Blueprint $table) {
            $table->id();
            $table->text('comments');
            $table->text('attachements');
            $table->UnsignedBigInteger('user_id');
            $table->UnsignedBigInteger('sitting_id');
            $table->UnsignedBigInteger('discipline_id');
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreign('discipline_id')->references('id')->on('discipline')->constrained()->onDelete('cascade');
            $table->foreign('sitting_id')->references('sitting_id')->on('discipline_sittings')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('discipline_reports');
    }
};
