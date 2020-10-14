<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Prepare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::table('cabangs')->insert(
            array(
                'name' => 'KCK'
            )
        );

        DB::table('roles')->insert(
            array(
                array(
                    'name' => 'Super Admin'
                ),
                array(
                    'name' => 'APK - Logistik'
                ),
                array(
                    'name' => 'APK - Pembukuan'
                ),
                array(
                    'name' => 'APK - SIC'
                ),
                array(
                    'name' => 'NON - APK Supervisor'
                ),
                array(
                    'name' => 'NON - APK'
                )
            )
        );

        DB::table('users')->insert(
            array(
                array(
                    'nip' => 'superadmin',
                    'name' => 'Super Admin',
                    'nohp' => '081280101919',
                    'email' => 'superadmin@bca.co.id',
                    'role_id' => 1,
                    'cabang_id' => 1,
                    'password' => bcrypt('123456')
                ),
                array(
                    'nip' => 'logistik',
                    'name' => 'Aku APK - Logistik',
                    'nohp' => '081280101919',
                    'email' => 'logistik@bca.co.id',
                    'role_id' => 2,
                    'cabang_id' => 1,
                    'password' => bcrypt('123456')
                ),
                array(
                    'nip' => 'pembukuan',
                    'name' => 'Aku APK - Pembukuan',
                    'nohp' => '081280101919',
                    'email' => 'pembukuan@bca.co.id',
                    'role_id' => 3,
                    'cabang_id' => 1,
                    'password' => bcrypt('123456')
                ),
                array(
                    'nip' => 'sic',
                    'name' => 'Aku APK - SIC',
                    'nohp' => '081280101919',
                    'email' => 'sic@bca.co.id',
                    'role_id' => 4,
                    'cabang_id' => 1,
                    'password' => bcrypt('123456')
                ),
                array(
                    'nip' => 'nonapkhc',
                    'name' => 'Aku Supervisor NON APK',
                    'nohp' => '081280101919',
                    'email' => 'nonapkhc@bca.co.id',
                    'role_id' => 5,
                    'cabang_id' => 1,
                    'password' => bcrypt('123456')
                ),
                array(
                    'nip' => 'nonapk',
                    'name' => 'Aku NON APK',
                    'nohp' => '081280101919',
                    'email' => 'nonapk@bca.co.id',
                    'role_id' => 6,
                    'cabang_id' => 1,
                    'password' => bcrypt('123456')
                )
            )
        );

        DB::table('jenisreimbursements')->insert(
            array(
                array(
                    'name' => 'Meeting/QG/QM'
                ),
                array(
                    'name' => 'Pembelian Barang'
                ),
                array(
                    'name' => 'Biaya Kendaraan'
                ),
                array(
                    'name' => 'Biaya Perbaikan Barang'
                ),
                array(
                    'name' => 'Lainnya'
                ),
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
