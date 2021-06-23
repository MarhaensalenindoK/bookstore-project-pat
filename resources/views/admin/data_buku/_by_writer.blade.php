@extends('layouts.app')

@section('content')
<div class="card text-center">
    <div class="card-header">
        Filter By Writer
    </div>
    <div class="card-body">
        <h5 class="card-title">Form Filter Buku Berdasarkan Penulis</h5>
        <div class="form-group form-inline text-right">
            <div class="clearfix"></div>
                <div class="controls">
                    <form method="post" action="{{url('admin/books-by-writer')}}" class=" myform form-group form-inline">
                        @csrf
                        <label class=" text-bold">Nama Penulis :</label>
                        <select class="form-select"  name="writer" required>
                            @foreach ($writers as $writer)
                                <option value="{{ $writer }}">{{ $writer }}</option>
                            @endforeach
                        </select>
                        <br>
                        <button type="submit" class="btn btn-lg btn-primary">Lihat</button>
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection