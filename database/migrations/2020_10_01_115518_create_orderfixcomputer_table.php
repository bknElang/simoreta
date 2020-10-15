<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderfixcomputerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderfixcomputer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('orderDate')->useCurrent();
            $table->foreignId('jenis_id')->nullable()->constrained('jeniskomponencomputer');
            $table->string('keterangan')->nullable();
            $table->string('status')->default('Waiting for Approval');
            $table->string('statusDetail')->nullable();
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
        Schema::dropIfExists('orderfixcomputer');
    }
}
