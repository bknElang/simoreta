<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktivas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('orderDate')->useCurrent();
            $table->string('jenisBarang');
            $table->string('spesifikasi');
            $table->string('keterangan')->nullable();
            $table->string('status')->default('Waiting for Approval');
            $table->string('statusDetail')->nullable();
            $table->foreignId('hc_id')->constrained('users');
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
        Schema::dropIfExists('aktivas');
    }
}
