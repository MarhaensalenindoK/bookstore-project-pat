<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;

class PopularBooks implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
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

        return collect($booksWithTransaction);
    }
}