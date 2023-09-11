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
        Schema::create('discipline_sittings', function (Blueprint $table) {
            $table->id('sitting_id');
            $table->string('category');
            $table->string('sittingDay')->default('NONE');
            $table->string('sittingTime')->default('NONE');
            $table->string('sittingVenue')->default('NONE');
            $table->UnsignedBigInteger('discipline_case');
            $table->string('decisionCategory')->nullable();
            $table->string('targetedAdvocate')->nullable();
            $table->longText('comment')->nullable();
            $table->string('attach_file')->nullable();
            $table->UnsignedBigInteger('scheduledBy');
            $table->foreign('discipline_case')->references('id')->on('discipline')->constrained()->onDelete('cascade');
            $table->foreign('scheduledBy')->references('id')->on('admins')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('discipline_sittings');
    }
};
