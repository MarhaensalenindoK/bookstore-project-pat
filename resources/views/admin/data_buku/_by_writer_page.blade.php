@extends('layouts.app')

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h1>Penulis : {{ $currentWriter}}</h1>
    </div>
    <div class="card-body">
        <div class="d-flex">
            <button class="btn btn-info m-1">Cetak</button>
            <button class="btn btn-success m-1">Export</button>
            <a type="button" href="{{url('/admin/books-by-writer')}}" class="btn btn-primary m-1">Pilih Lainnya</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Judul</th>
                        <th scope="col">No ISBN</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Harga Pokok</th>
                        <th scope="col">Harga Jual</th>
                        <th scope="col">Diskon</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{$book->id_buku}}</td>
                        <td>{{$book->judul}}</td>
                        <td>{{$book->noisbn}}</td>
                        <td>{{$book->penulis}}</td>
                        <td>{{$book->penerbit}}</td>
                        <td>{{$book->tahun}}</td>
                        <td>{{$book->harga_pokok}}</td>
                        <td>{{$book->harga_jual}}</td>
                        <td>{{$book->diskon}}%</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection