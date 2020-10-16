<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestjobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestjobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('orderDate')->useCurrent();
            $table->string('keterangan');
            $table->string('jenis');
            $table->foreignId('roles_to_id')->constrained('roles');
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
        Schema::dropIfExists('requestjobs');
    }
}
