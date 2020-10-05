<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignkendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignkendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('namaDriver');
            $table->string('jenisKendaraan');
            $table->string('plateNumber');
            $table->string('nohpDriver');
            $table->string('pinPenumpang');
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
        Schema::dropIfExists('assignkendaraans');
    }
}
