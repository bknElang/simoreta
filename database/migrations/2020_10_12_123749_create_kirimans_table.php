<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKirimansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kirimans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('orderDate')->useCurrent();
            $table->string('jenisKiriman');
            $table->string('asuransi');
            $table->string('pertanggungan')->nullable();
            $table->string('namaDebitur');
            $table->string('namaPIC');
            $table->string('alamat');
            $table->string('noPenerima');
            $table->string('dokumen');
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
        Schema::dropIfExists('kirimans');
    }
}
