<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderkendaraansTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderkendaraans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assign_id')->nullable()->constrained('assignkendaraans');
            $table->string('status')->default('Waiting for Approval');
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('orderDate')->useCurrent();
            $table->dateTime('useDatetime');
            $table->dateTime('finishDatetime');
            $table->string('pickupAddress');
            $table->string('destinationAddress');
            $table->string('necessity')->nullable();
            $table->integer('totalPassanger');
            $table->string('keterangan');
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
        Schema::dropIfExists('orderkendaraans');
    }
}
