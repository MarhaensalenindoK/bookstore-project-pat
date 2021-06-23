@extends('layouts.app')

@section('content')
<div class="card mt-5">
    <div class="card-header">
        Selamat Datang Di Toko Buku Marhaenika
    </div>
    <div class="card-body">
        <h5 class="card-title">Kamu Sebagai <span class=" text-uppercase">{{ Auth::user()->level }}</span></h5>
        <h6>Anda dapat mengakses :</h6>
    </div>
</div>

<div class="accordion" id="accordionExample">
    <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Inputan
        </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            Anda dapat mengakses Inputan <strong>Buku</strong> dan <strong>Distributor</strong>
            <ul class=" list-unstyled">
                <li><a class="btn btn-primary mt-3" href="{{ url(Auth::user()->level.'/input-distributor') }}">Input Distributor</a></li>
                <li><a class="btn btn-primary mt-3" href="{{ url(Auth::user()->level.'/input-buku') }}">Input Buku</a></li>
            </ul>
        </div>
    </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Laporan
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                Anda dapat mengakses Laporan <strong>Pasok Buku</strong> dan <strong>Filter Pasok Buku</strong>
                <ul class=" list-unstyled">
                    <li><a class="btn btn-primary mt-3" href="{{url(Auth::user()->level.'/pasok-buku')}}">Pasok Buku</a></li>
                    <li><a class="btn btn-primary mt-3" href="{{url(Auth::user()->level.'/filter-pasok-buku')}}">Filter Pasok Buku</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection