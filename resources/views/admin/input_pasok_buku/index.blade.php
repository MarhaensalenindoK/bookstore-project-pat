@extends('layouts.app')

@section('content')
<div class="card card-primary card-outline mt-3">
    <div class="card-body">
        <div class="card-body mb-3">
            <h3>Form Buku</h3>
            @if (Session::has('success'))
            <div class="alert alert-primary" role="alert">
                {{ Session::get('success') }}
            </div>
            @endif
            
        </div>

        <form action="{{url($user->level.'/input-pasok-buku')}}" method="post">
            @csrf
            <div class="form-group mt-3">
                <select class="form-select" name="distributor_id">
                    @if ($distributors)
                        @foreach ($distributors as $distributor)   
                        <option value="{{ $distributor['id_distributor'] }}"> {{ $distributor['nama_distributor'] }} </option>
                        @endforeach
                    @else
                        <option value="" selected>Tidak ada data</option>
                    @endif
                </select>
            </div>
            <div class="form-group  mt-3">
                <h6 class="form-label">Pilih Buku</h6>
                <select class="form-select"  name="book_id" required>
                    @foreach ($books as $book)
                        <option value="{{ $book['id_buku'] }}">{{ $book['judul'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <h6 class="form-label">Jumlah</h6>
                <input type="number" min="0" id="jumlah" name="jumlah" class="form-control" required>
            </div>

            <div class="form-group mt-3">
                <h6 class="form-label">Tanggal</h6>
                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
            </div>
            
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
    
    <div class="card-body mt-3">
        <table class="table table-hover table-bordered">
            <thead>
                <th>No</th>
                <th>Nama Distributor</th>
                <th>Judul Buku</th>
                <th>NO ISBN</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Jumlah Pasok</th>
                <th>Tanggal</th>
            </thead>
            <tbody>
            @if ($dataSuply)
                @foreach($dataSuply as $suply)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $suply['distributor']['nama_distributor'] }}</td>
                        <td>{{$suply['book']['judul']}}</td>
                        <td>{{$suply['book']['noisbn']}}</td>
                        <td>{{$suply['book']['penulis']}}</td>
                        <td>{{$suply['book']['penerbit']}}</td>
                        <td>{{$suply['book']['harga_jual']}}</td>
                        <td>{{$suply['book']['stok']}}</td>
                        <td>{{$suply['jumlah']}}</td>
                        <td>{{$suply['tanggal']}}</td>
                    </tr>
                @endforeach
            @else
            <tr>
                <td colspan="10" class="text-center">Tidak ada data.</td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>
    
</div>
@endsection