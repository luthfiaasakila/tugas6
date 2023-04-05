<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = produk::all();
        return view('produk.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create', ['kategori'=> $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_produk' => 'required',
            'foto_produk' => 'required',
            'deskripsi_produk' => 'required',
            'harga_produk' => 'required',
            'jumlah_produk' => 'required',
            'id_kategori' => 'required'
        ]);
        $foto_produk = $request->file('foto_produk')->store('produk', 'public');
        $insert = produk::create([
            'nama_produk' => $request->nama_produk,
            'foto_produk' => $foto_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga_produk' => $request->harga_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'id_kategori' => $request->id_kategori
        ]);
        if ($insert) {
            return redirect('produk')->with('success', 'Berhasil menambahkan data');
        }else{
            return redirect('create')->withErrors('Gagal menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = produk::where(['id' => $id])->first();
        $kategori = Kategori::all();
        return view('produk.edit',['data' => $data,'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validasi = $request->validate([
            'nama_produk' => 'required',
            'deskripsi_produk' => 'required',
            'harga_produk' => 'required',
            'jumlah_produk' => 'required',
            'id_kategori' => 'required'
        ]);
        if ($request->foto_produk != null) {
            $data_image = produk::where(['id' => $id])->first();
            if (File::exists($data_image->nama_produk)) {
                File::delete($data_image->nama_produk);
            }
            $foto_produk = $request->file('foto_produk')->store('Produk', 'public');
            $update = produk::where(['id'=> $id])->update([
                'nama_produk' => $request->nama_produk,
                'foto_produk' => $foto_produk,
                'deskripsi_produk' => $request->deskripsi_produk,
                'harga_produk' => $request->harga_produk,
                'jumlah_produk' => $request->jumlah_produk,
                'id_kategori' => $request->id_kategori
            ]);
        }else{
            $update = produk::where(['id'=> $id])->update([
                'nama_produk' => $request->nama_produk,
                'deskripsi_produk' => $request->deskripsi_produk,
                'harga_produk' => $request->harga_produk,
                'jumlah_produk' => $request->jumlah_produk,
                'id_kategori' => $request->id_kategori
            ]);
        }
        if ($update) {
            return redirect('produk')->with('success', 'Berhasil edit data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = produk::find($id)->delete();
        return redirect('produk')->with('success', 'Berhasil menghapus data');
    }
}