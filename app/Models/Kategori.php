<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    public function aktif()
    {
        $query = DB::table('kategori')
            ->where('status', 'Active')
            ->orderBy('nama_kategori', 'ASC')
            ->get();
        return $query;
    }
}
