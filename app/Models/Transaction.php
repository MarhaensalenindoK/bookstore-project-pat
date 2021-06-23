<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "sales";
    protected $primaryKey = "id_penjualan";
    public $incrementing = false;
    protected $fillable = [
        'id_penjualan', 'id_buku', 'id_kasir', 'jumlah_beli', 'bayar', 'kembalian', 'total_harga', 'tanggal', 'created_at', 'updated_at'
    ];

    public function book()
    {
        return $this->hasOne(Book::class, 'id_buku', 'id_buku');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_user', 'id_kasir');
    }
}