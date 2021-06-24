<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Book Store Marhaenika</title>
  </head>
  <body onLoad="window.print()">
    
    <div class="container">
        <div class="card text-center mt-5">
            <div class="card-header">
                LAPORAN SEMUA PASOK
            </div>
            <div class="card-body">
                <p class="card-text">Tanggal Cetak : {{ $myTime }}</p>
                <div class="table-responsive">
                    <table class=" table table-hover table-bordered">
                        <thead>
                            <th>No</th>
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
                            @foreach ($dataSuply as $book)    
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book['book']['judul'] }}</td>
                                <td>{{ $book['book']['noisbn'] }}</td>
                                <td>{{ $book['book']['penulis'] }}</td>
                                <td>{{ $book['book']['penerbit'] }}</td>
                                <td>{{ $book['book']['harga_jual'] }}</td>
                                <td>{{ $book['book']['stok'] }}</td>
                                <td>{{ $book['jumlah'] }}</td>
                                <td>{{ $book['tanggal'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>
</html>