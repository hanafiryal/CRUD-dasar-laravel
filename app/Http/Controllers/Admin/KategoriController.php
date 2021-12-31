<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Listing data kategori
        $kategori = Kategori::get();
        // $kategori = DB::table('kategori')->get();

        // dd($kategori);
        $data = [
            'title'     => 'Data Kategori',
            'kategori'  => $kategori
        ];
        return view('admin.kategori.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Rules
        $rules = [
            'nama_kategori' => [
                'required',
                'unique:kategori'
            ],
            'jumlah' => [
                'required'
            ],
            'status' => [
                'required'
            ]
        ];

        // Custom Attribute
        $attribute = [
            'nama_kategori' => 'Nama Kategori',
            'jumlah'        => 'Jumlah',
            'status'        => 'Status'
        ];

        // Custom Message
        $message = [
            'required'  => ':attribute tidak boleh kosong',
            'unique'    => ':attribute sudah digunakan, silahkan ganti dengan nama lain'
        ];

        // Proses Validasi
        $validator = Validator::make($request->all(), $rules, $message, $attribute);

        if ($validator->fails()) {
            return redirect()->route('admin.kategori')->withErrors($validator)->withInput()->with(['warning'    => 'Silahkan periksa form input, data tidak tersimpan']);
        }

        $data = [
            'nama_kategori' => $request->nama_kategori,
            'jumlah'        => $request->jumlah,
            'status'        => $request->status,
            'created_at'    => now(),
            'updated_at'    => now()
        ];
        DB::table('kategori')->insert($data);

        return redirect()->route('admin.kategori')->with(['success'    => 'Data berhasil di simpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_kategori)
    {
        // Detail kategori berdasarkan id
        $kategori = Db::table('kategori')->where('id_kategori', $id_kategori)->first();
        $data = [
            'title'     => 'Detail Kategori',
            'kategori'  => $kategori
        ];
        return view('admin.kategori.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kategori)
    {
        // Detail kategori
        $kategori = Kategori::where('id_kategori', $id_kategori)->first();
        // dd($kategori);
        $data = [
            'title'     => 'Edit Kategori',
            'kategori'  => $kategori
        ];
        return view('admin.kategori.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kategori)
    {
        // Rules
        $rules = [
            'nama_kategori' => [
                'required',
                Rule::unique('kategori')->ignore($id_kategori, 'id_kategori')
            ],
            'jumlah' => [
                'required'
            ],
            'status' => [
                'required'
            ]
        ];

        // Custom Attribute
        $attribute = [
            'nama_kategori' => 'Nama Kategori',
            'status'        => 'Status'
        ];

        // Custom Message
        $message = [
            'required'  => ':attribute tidak boleh kosong',
            'unique'    => ':attribute sudah digunakan, silahkan ganti dengan nama lain'
        ];

        // Proses Validasi
        $validator = Validator::make($request->all(), $rules, $message, $attribute);

        if ($validator->fails()) {
            return redirect()->route('admin.edit_kategori', $id_kategori)->withErrors($validator)->withInput();
        }

        $data = [
            'nama_kategori' => $request->nama_kategori,
            'jumlah'         => $request->jumlah,
            'status'        => $request->status,
            'updated_at'    => now()
        ];
        DB::table('kategori')->where('id_kategori', $id_kategori)->update($data);

        return redirect()->route('admin.kategori')->with(['success'    => 'Data berhasil di update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kategori)
    {
        $kategori = Kategori::find($id_kategori);

        if (is_null($kategori)) {
            return redirect()->route('admin.kategori')->with(['danger'    => 'Data tidak di temukan']);
        }

        $kategori->delete();
        return redirect()->route('admin.kategori')->with(['success'    => 'Data berhasil di hapus']);
    }
}
