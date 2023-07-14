<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reg_no');
            $table->string('examid');
            $table->string('sub_id1');
            $table->integer('sub_id1_mark');
            $table->string('sub_id2');
            $table->integer('sub_id2_mark');
            $table->string('sub_id3');
            $table->integer('sub_id3_mark');
            $table->integer('total_mark');
            $table->string('result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
