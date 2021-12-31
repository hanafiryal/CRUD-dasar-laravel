<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    public function listing_pagination_search($request)
    {
        $query = DB::table('produk')
            ->when($request->search, function($query) use ($request) {
                $query->where('produk.nama_produk', 'like', "%{ $request->search }%")
                    ->orWhere('produk.status', 'like', "%{ $request->search }%");
            })
            ->leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
            ->select('produk.*', 'kategori.nama_kategori')
            ->orderBy('id_produk', 'DESC')
            ->paginate($request->limit ?? 10);
        return $query;
    }

    public function detail($id_produk)
    {
        $query = DB::table('produk')
            ->leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
            ->select('produk.*', 'kategori.nama_kategori')
            ->where('produk.id_produk', $id_produk)
            ->first();
            return $query;
    }
}
