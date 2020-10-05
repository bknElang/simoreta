<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderreimbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderreimbursements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('orderDate')->useCurrent();
            $table->string('keterangan')->nullable();
            $table->string('namaRek');
            $table->string('nomorRek');
            $table->string('bankRek');
            $table->string('nominal');
            $table->foreignId('jenis_id')->nullable()->constrained('jenisreimbursements');
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
        Schema::dropIfExists('orderreimbursements');
    }
}
