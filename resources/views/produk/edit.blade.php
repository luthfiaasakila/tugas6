@extends('layout.template')
@section('konten')
<div class="row">
    <div class="col-md-12">
        <h2>Edit Produk</h2>
        <br>
        <a href="{{ url('produk') }}" class="btn btn-secondary"><--Kembali</a>
        <form action="/produk/{{$data->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control" name="nama_produk" value="{{ $data->nama_produk }}" placeholder="Masukkan Nama Produk">
            </div>
            <div class="mb-3">
                <label for="foto_produk">Foto Produk</label>
                <input type="file" class="form-control" name="foto_produk" placeholder="Pilih">
            </div>
            <div class="mb-3">
                <label for="deskripsi_produk">Deskripsi Produk</label>
                <textarea name="deskripsi_produk" id="" cols="30" rows="10" placeholder="Masukkan Deskripsi Produk" class="form-control"> {{ $data->nama_produk }}</textarea>
            </div>
            <div class="mb-3">
                <label for="nama_produk">Harga Produk</label>
                <input type="number" class="form-control" name="harga_produk" placeholder="Masukkan Harga Produk" value="{{ $data->harga_produk }}">
            </div>
            <div class="mb-3">
                <label for="nama_produk">Jumlah Produk</label>
                <input type="number" class="form-control" name="jumlah_produk" placeholder="Masukkan Jumlah Produk" value="{{ $data->jumlah_produk }}">
            </div>
            <div class="mb-3">
                <label for="kategori">Kategori</label>
                <select class="form-control" name="id_kategori" id="">
                    @foreach ($kategori as $kt)
                        <option value="{{ $kt->id }}" @if ($kt->nama_kategori == $data->nama_kategori) selected @endif>{{$kt->nama_kategori}} @if ($kt->nama_kategori == $data->nama_kategori) (Terpilih) @endif</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Simpan" class="btn btn-md btn-success">
        </form>
    </div>
</div>
@endsection