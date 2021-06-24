
<?php
namespace App\Exports;

use App\Models\Supply;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class Sales implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $transactions = Transaction::all();

        foreach ($transactions as $transaction) {
            $transaction['book'] = $transaction->book;
        }

        return collect($transactions);
    }
}