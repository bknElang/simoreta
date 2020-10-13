<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aaks', function (Blueprint $table) {
            $table->id();
            $table->dateTime('orderDate')->useCurrent();
            $table->foreignId('user_id')->constrained('users');
            $table->string('filename');
            $table->string('status')->default('PENDING');
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
        Schema::dropIfExists('aaks');
    }
}
