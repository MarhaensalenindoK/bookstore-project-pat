@extends('layouts.app')

@section('content')
<div class="card mt-5">
    <div class="card-header">
        Selamat Datang Di Toko Buku Marhaenika
    </div>
    <div class="card-body">
        <h5 class="card-title">Kamu Sebagai <span class=" text-uppercase text-danger">{{ Auth::user()->level }}</span></h5>
    </div>
</div>
@endsection