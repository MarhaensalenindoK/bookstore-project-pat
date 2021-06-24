<?php
namespace App\Exports;

use App\Models\Suply;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllSupply implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $supplies = Suply::orderBy('tanggal', 'desc')->get();
        $dataSupply = [];
        foreach($supplies as $key => $supply){
            $supply['distributor'] = $supply->distributor;
            $supply['book'] = $supply->book;
            $dataSupply[$key] = $supply;
        }

        return collect($dataSupply);
    }
}