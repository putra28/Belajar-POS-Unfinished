<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $procedure = "
            CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getmenu`()
            LANGUAGE SQL
            NOT DETERMINISTIC
            CONTAINS SQL
            SQL SECURITY DEFINER
            COMMENT ''
            BEGIN
                SELECT
                    p.id_produk AS produk_id,
                    p.nama_produk,
                    p.harga_produk,
                    p.stok_produk,
                    k.nama_kategori,
                    k.sub_kategori
                FROM
                    tb_produk p
                INNER JOIN
                    tb_kategori k ON p.kategori_id = k.id;
            END
        ";

        DB::unprepared($procedure);
    }

    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_getmenu');
    }
};
