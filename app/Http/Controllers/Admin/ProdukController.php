<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTTP;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Produk $produk)
    {
        $limit = $request->limit;
        $produk = $produk->listing_pagination_search($request);
        $produk->appends($request->only('search', 'limit'));
        // dd($limit);

        $data = [
            'title'     => 'Data Produk',
            'produk'    => $produk,
            'limit'     => $limit
        ];
        return view('admin.produk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin');

        // $kategori = $kategori->aktif();
        // dd($kategori);

        // Contoh penerapan/ penggunaan API di laravel
        $url = 'http://127.0.0.1:8000/api/v1/kategori';
        $kategori = file_get_contents($url);
        $kategori = json_decode($kategori);
        foreach ($kategori->data as $key => $val) {
            $kat[$key] = $val;
        }
        // dd(collect($kat));

        $data = [
            'title'     => 'Tambah Produk',
            'kategori'  => collect($kat)
        ];
        return view('admin.produk.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');

        // Rules
        $rules = [
            'nama_produk' => [
                'required',
                'unique:produk'
            ],
            'sku_produk' => [
                'required',
                'unique:produk'
            ],
            'harga_produk' => [
                'required'
            ],
            'status' => [
                'required'
            ],
            'gambar' => 'file|image|mimes:jpeg,jpg,png|max:2048'
        ];

        // Custom Attribute
        $attribute = [
            'nama_produk'   => 'Nama Produk',
            'sku_produk'    => 'SKU Produk',
            'harga_produk'  => 'Harga Produk',
            'status'        => 'Status',
            'gambar'        => 'Foto/ Gambar',
        ];

        // Custom Message
        $message = [
            'required'  => ':attribute tidak boleh kosong',
            'unique'    => ':attribute sudah digunakan, silahkan ganti dengan nama lain',
            'max'       => ':attribute maksimal 2MB',
            'mimes'     => ':attribute harus berekstensi .jpg, .jpeg, .png',
            'image'     => ':attribute yang di upload harus gambar'
        ];

        // Proses Validasi
        $validator = Validator::make($request->all(), $rules, $message, $attribute);

        // Validasi gagal
        if ($validator->fails()) {
            return redirect()->route('admin.tambah_produk')->withErrors($validator)->withInput();
        }

        // Upload foto/ gambar
        $gambar = '';
        if ($request->hasFile('gambar')) {
            $path_file  = $request->file('gambar')->store('./assets/uploads/images', 'public');
            $gambar     = basename($path_file);
        }
        // var_dump($path_file);
        // dd($path_file);

        $data = [
            'id_kategori'   => $request->id_kategori,
            'nama_produk'   => $request->nama_produk,
            'sku_produk'    => $request->sku_produk,
            'harga_produk'  => $request->harga_produk,
            'deskripsi'     => $request->deskripsi,
            'gambar'        => $gambar,
            'status'        => $request->status,
            'created_at'    => now(),
            'updated_at'    => now()
        ];
        DB::table('produk')->insert($data);

        return redirect()->route('admin.produk')->with(['success'    => 'Data produk berhasil di simpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk, Kategori $kategori, $id_produk)
    {
        $this->authorize('isAdmin');

        // Detail produk
        $produk     = $produk->detail($id_produk);
        $kategori   = $kategori->aktif();
        // dd($kategori);
        $data = [
            'title'     => 'Edit Produk',
            'produk'    => $produk,
            'kategori'  => $kategori
        ];
        return view('admin.produk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk, $id_produk)
    {
        $this->authorize('isAdmin');

        $produk = $produk->detail($id_produk);
        // dd($produk);

        // Rules
        $rules = [
            'nama_produk' => [
                'required',
                Rule::unique('produk')->ignore($id_produk, 'id_produk')
            ],
            'sku_produk' => [
                'required',
                Rule::unique('produk')->ignore($id_produk, 'id_produk')
            ],
            'harga_produk' => [
                'required'
            ],
            'status' => [
                'required'
            ],
            'gambar' => 'file|image|mimes:jpeg,jpg,png|max:2048'
        ];

        // Custom Attribute
        $attribute = [
            'nama_produk'   => 'Nama Produk',
            'sku_produk'    => 'SKU Produk',
            'harga_produk'  => 'Harga Produk',
            'status'        => 'Status',
            'gambar'        => 'Foto/ Gambar',
        ];

        // Custom Message
        $message = [
            'required'  => ':attribute tidak boleh kosong',
            'unique'    => ':attribute sudah digunakan, silahkan ganti dengan nama lain',
            'max'       => ':attribute maksimal 2MB',
            'mimes'     => ':attribute harus berekstensi .jpg, .jpeg, .png',
            'image'     => ':attribute yang di upload harus gambar'
        ];

        // Proses Validasi
        $validator = Validator::make($request->all(), $rules, $message, $attribute);

        // Validasi gagal
        if ($validator->fails()) {
            return redirect()->route('admin.edit_produk', $id_produk)->withErrors($validator)->withInput();
        }

        // Upload foto/ gambar
        $gambar = $produk->gambar;
        // dd($gambar);
        if ($request->hasFile('gambar')) {
            $path_file = './assets/uploads/images/' . $produk->gambar;
            // dd($path_file);
            if (file_exists($path_file)) {
                unlink($path_file);
            }
            $path_file  = $request->file('gambar')->store('./assets/uploads/images', 'public');
            $gambar     = basename($path_file);
            // dd($gambar);
        }

        $data = [
            'id_kategori'   => $request->id_kategori,
            'nama_produk'   => $request->nama_produk,
            'sku_produk'    => $request->sku_produk,
            'harga_produk'  => $request->harga_produk,
            'deskripsi'     => $request->deskripsi,
            'gambar'        => $gambar,
            'status'        => $request->status,
            'updated_at'    => now()
        ];
        DB::table('produk')->where('id_produk', $id_produk)->update($data);

        return redirect()->route('admin.produk')->with(['success'    => 'Data produk berhasil di update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk, $id_produk)
    {
        $this->authorize('isAdmin');

        $produk = Produk::find($id_produk);

        if (is_null($produk)) {
            return redirect()->route('admin.produk')->with(['danger'    => 'Data tidak di temukan']);
        }

        $path_file = './storage/assets/uploads/images/' . $produk->gambar;
        // dd($path_file);
        if (file_exists($path_file)) {
            unlink($path_file);
        }

        $produk->delete();
        return redirect()->route('admin.produk')->with(['success'    => 'Data berhasil di hapus']);
    }
}
