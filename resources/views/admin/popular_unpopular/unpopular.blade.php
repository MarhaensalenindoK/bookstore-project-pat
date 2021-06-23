@extends('layouts.app')

@section('content')
<div class="card mt-3">
    <div class="card-header">
        Buku Yang Tidak Pernah Terjual
    </div>
    <div class="card-body">
        <div class="d-flex">
            <a href="{{url('admin/report/export-unpopular')}}" class="btn btn-success m-1">Export</a>
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
                        <th scope="col">Harga Jual</th>
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
                        <td>{{$book->harga_jual}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection