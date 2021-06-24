<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\AllBooks;
use App\Exports\AllSupply;
use App\Exports\PopularBooks;
use App\Exports\UnpopularBooks;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Book;
use App\Models\Suply;
use App\Models\Distributor;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Faker\Factory as Faker;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/bookStore');
    }

    public function indexPasokBuku ()
    {
        $user = Auth::user();
        $suplys = Suply::orderBy('tanggal', 'desc')->get();
        $dataDates = $suplys->pluck('tanggal');
        $dates = [];
        foreach ($dataDates as $key => $arrDates) {
            if(in_array($arrDates, $dates)){
                continue;
            }
            $dates[$key] = $arrDates;
        }
        array_unique((array)$dates);

        return view('admin.pasok_buku.index', compact('user', 'dates'));
    }

    public function allBooks()
    {
        $user = Auth::user();
        $books = Book::all();

        return view('admin.data_buku.index', compact('user', 'books'));
    }

    public function booksByWriterForm()
    {
        $user = Auth::user();
        $writers =  Book::get()->pluck('penulis');

        return view('admin.data_buku._by_writer')
        ->with('user', $user)
        ->with('writers', $writers);
    }

    public function booksByWriter(Request $request)
    {
        $userRole = Auth::user()->akses;
        $books = Book::where('penulis', $request->writer)->get();
        $writers =  Book::get()->pluck('penulis');


        return view('admin.data_buku._by_writer_page')
        ->with('userRole', $userRole)
        ->with('books', $books)
        ->with('currentWriter', $request->writer)
        ->with('writers', $writers);
    }

    public function popularBooks()
    {
        $user = Auth::user();
        $books = Book::with('transactions')->get();

        $booksWithTransaction = [];
        foreach($books as $book){
            if(count($book->transactions) > 0){
                array_push($booksWithTransaction, $book);
            }
        }

        foreach($booksWithTransaction as $key => $book)
        {
            $totalSold = 0;
            foreach($book->transactions as $transaction){
                $totalSold += $transaction->jumlah_beli;
            }

            $booksWithTransaction[$key]['total_sold'] = $totalSold;
            $booksWithTransaction[$key]['total_transaction'] = count($book->transactions);
        }

        return view('admin.popular_unpopular.popular')
        ->with('user', $user)
        ->with('books', $booksWithTransaction)
        ->with('page', 'REPORT');
    }

    public function unpopularBooks()
    {
        $userRole = Auth::user()->akses;
        $books = Book::with('transactions')->get();

        $booksWithNoTransaction = [];
        foreach($books as $book){
            if(count($book->transactions) === 0){
                array_push($booksWithNoTransaction, $book);
            }
        }

        return view('admin.popular_unpopular.unpopular')
        ->with('userRole', $userRole)
        ->with('books', $booksWithNoTransaction);
    }

    public function getPasok ()
    {
        $suplys = Suply::orderBy('tanggal', 'desc')->get();
        $dataSuply = [];
        foreach($suplys as $suply){
            $suply['distributor'] = $suply->distributor;
            $suply['book'] = $suply->book;
            array_push($dataSuply , $suply);
        }

        return $dataSuply;
    }

    public function pasokByYear (Request $req)
    {
        $suplys = Suply::all();
        $suplysByDate = $suplys->where('tanggal', $req->tanggal);
        $dataSuply = [];

        foreach($suplysByDate as $suply){
            $suply['distributor'] = $suply->distributor;
            $suply['book'] = $suply->book;
            array_push($dataSuply , $suply);
        }

        return $dataSuply;
    }

    public function indexFilterPasokBuku ()
    {
        $user = Auth::user();
        $distributors = Distributor::all();

        return view('admin.filter_pasok_buku.index', compact('user','distributors'));
    }
    
    public function filterByDistributor (Request $req)
    {
        $suplys = Suply::all()->where('id_distributor', $req->distributor);
        $distributor = Distributor::where('id_distributor', $req->distributor)->first();
        $mytime = date("d/m/Y");
        $dataSuply = [];
        foreach($suplys as $suply){
            $suply['distributor'] = $suply->distributor;
            $suply['book'] = $suply->book;
            array_push($dataSuply , $suply);
        }
        $countBook = 0;
        foreach($dataSuply as $book){
            $countBook += $book['book']['stok'];
        }

        return view('admin.filter_pasok_buku.form',compact('dataSuply','distributor','mytime','countBook'));
    }

    // Input
    public function indexInputBuku ()
    {
        $faker = Faker::create('id_ID');
        $books = Book::all();
        $bookId = $faker->unique()->numerify('BK#######');
        $user = Auth::user();

        return view('admin.input_buku.index', compact('books', 'bookId', 'user'));
    }

    public function addBook (Request $req)
    {
        Book::create([
            'id_buku' => $req->id_buku,
            'judul' => $req->judul,
            'noisbn' => $req->noisbn,
            'penulis' => $req->penulis,
            'penerbit' => $req->penerbit,
            'tahun' => $req->tahun,
            'stok' => Book::DEFAULT_STOCK,
            'harga_pokok' => $req->harga_pokok,
            'harga_jual' => $req->harga_jual,
            'ppn' => Book::TAX,
            'diskon' => $req->diskon,
        ]);

        return back()->with('success', 'Data Berhasil Disimpan');
    }

    public function editBook(Request $req)
    {
        $book = Book::where('id_buku', $req->id_buku);
        $book->update([
            'id_buku' => $req->id_buku,
            'judul' => $req->judul,
            'noisbn' => $req->noisbn,
            'penulis' => $req->penulis,
            'penerbit' => $req->penerbit,
            'tahun' => $req->tahun,
            'stok' => 0,
            'harga_pokok' => $req->harga_pokok,
            'harga_jual' => $req->harga_jual,
            'ppn' => 10,
            'diskon' => $req->diskon,
        ]);

        return back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleteBook($id_buku)
    {
        $book = Book::where('id_buku', $id_buku);
        $book->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function indexInputDistributor()
    {
        $distributors = distributor::all();
        $user = Auth::user();

        return view('admin.input_distributor.index', compact('distributors', 'user'));
    }

    public function addDistributor(Request $req)
    {
        distributor::create([
            'nama_distributor' => $req->nama,
            'alamat' => $req->alamat,
            'telepon' => $req->telepon,
        ]);

        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function editDistributor(Request $req)
    {
        $distributor = distributor::where('id_distributor',$req->id_distributor);
        $distributor->update([
            'nama_distributor' => $req->nama,
            'alamat' => $req->alamat,
            'telepon' => $req->telepon,
        ]);

        return back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleteDistributor(Request $req)
    {
        $distributor = distributor::where('id_distributor', $req->id_distributor);
        $distributor->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function indexInputPasokBuku()
    {
        $user = Auth::user();
        $books = Book::all();
        $suplys = Suply::orderBy('tanggal', 'desc')->get();
        $distributors = Distributor::all();
        $dataSuply = [];
        foreach($suplys as $key => $suply){
            $dataSuply[$key] = $suply;
            $dataSuply[$key]['distributor'] = $suply->distributor;
            $dataSuply[$key]['book'] = $suply->book;
        }
        
        return view('admin.input_Pasok_buku.index', compact('dataSuply', 'user', 'distributors', 'books'));
    }

    public function inputPasokBuku(Request $request)
    {
        $book = Book::findOrFail($request->book_id);

        $supply = new Suply;

        $supply->id_distributor = $request->distributor_id;
        $supply->id_buku = $request->book_id;
        $supply->jumlah = $request->jumlah;
        $supply->tanggal = $request->tanggal;

        $supply->save();

        $plusStok = $book->stok + $request->jumlah;

        $book->update([
            'stok' => $plusStok,
        ]);

        $book->save();

        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function cetakPasok()
    {
        $suplys = Suply::orderBy('tanggal', 'desc')->get();
        $dataSuply = [];
        foreach($suplys as $suply){
            $suply['distributor'] = $suply->distributor;
            $suply['book'] = $suply->book;
            array_push($dataSuply , $suply);
        }
        $myTime = Carbon::now()->format('Y-m-d');

        return view('admin.pasok_buku.cetak', compact('dataSuply', 'myTime'));
    }

    public function exportAll()
    {
        return Excel::download(new AllBooks, 'semua-buku.xlsx');
    }

    public function exportPopular()
    {
        return Excel::download(new PopularBooks, 'buku-terjual.xlsx');
    }

    public function exportUnpopular()
    {
        return Excel::download(new UnpopularBooks, 'buku-tidak-terjual.xlsx');
    }

    public function exportSupply()
    {
        return Excel::download(new AllSupply, 'semua-pasok.xlsx');
    }
}