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
        Schema::create('tbl4_d_results', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('n1',4)->nullable();
            $table->string('n1_pos')->nullable();
            $table->string('n2',4)->nullable();
            $table->string('n2_pos')->nullable();
            $table->string('n3',4)->nullable();
            $table->string('n3_pos')->nullable();
            $table->string('s1',4)->nullable();
            $table->string('s2',4)->nullable();
            $table->string('s3',4)->nullable();
            $table->string('s4',4)->nullable();
            $table->string('s5',4)->nullable();
            $table->string('s6',4)->nullable();
            $table->string('s7',4)->nullable();
            $table->string('s8',4)->nullable();
            $table->string('s9',4)->nullable();
            $table->string('s10',4)->nullable();
            $table->string('s11',4)->nullable();
            $table->string('s12',4)->nullable();
            $table->string('s13',4)->nullable();
            $table->string('c1',4)->nullable();
            $table->string('c2',4)->nullable();
            $table->string('c3',4)->nullable();
            $table->string('c4',4)->nullable();
            $table->string('c5',4)->nullable();
            $table->string('c6',4)->nullable();
            $table->string('c7',4)->nullable();
            $table->string('c8',4)->nullable();
            $table->string('c9',4)->nullable();
            $table->string('c10',4)->nullable();
            $table->string('dd')->nullable();
            $table->string('dn')->nullable();
            $table->string('day')->nullable();
            $table->string('n11',4)->nullable();
            $table->string('n12',4)->nullable();
            $table->string('n13',4)->nullable();
            $table->string('isLive',1)->nullable();
            $table->string('count')->nullable();
            $table->string('jackpotAmount')->nullable();
            $table->string('videoUrl')->nullable();
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
        Schema::dropIfExists('tbl4_d_results');
    }
};
