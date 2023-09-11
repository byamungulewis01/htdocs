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
        Schema::create('case_notify_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_id');
            $table->text('message');
            $table->string('defandant_name')->nullable();
            $table->string('plaintiff_name')->nullable();
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
        Schema::dropIfExists('case_notify_records');
    }
};
