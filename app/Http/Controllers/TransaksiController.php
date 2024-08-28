<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $get_menu = DB::select('CALL sp_getmenu()');

        // Struktur data
        $data = [];

        // Proses hasil query
        foreach ($get_menu as $row) {
            // Tambahkan kategori jika belum ada
            if (!isset($data[$row->nama_kategori])) {
                $data[$row->nama_kategori] = [];
            }

            // Tambahkan sub_kategori jika belum ada
            if (!isset($data[$row->nama_kategori][$row->sub_kategori])) {
                $data[$row->nama_kategori][$row->sub_kategori] = [];
            }

            // Tambahkan produk ke sub_kategori
            $data[$row->nama_kategori][$row->sub_kategori][] = [
                'id_produk' => $row->produk_id,
                'nama_produk' => $row->nama_produk,
                'harga_produk' => $row->harga_produk,
                'stok_produk' => $row->stok_produk,
            ];
        }

        // dd($data);
        return view('transaksi.index', ['title' => 'Halaman Transaksi', 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
