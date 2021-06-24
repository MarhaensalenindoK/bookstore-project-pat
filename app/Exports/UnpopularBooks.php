<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;

class UnpopularBooks implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $books = Book::with('transactions')->get();

        $booksWithNoTransaction = [];
        foreach($books as $book){
            if(count($book->transactions) === 0){
                array_push($booksWithNoTransaction, $book);
            }
        }

        return collect($booksWithNoTransaction);
    }
}