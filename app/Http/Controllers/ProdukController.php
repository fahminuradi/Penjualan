<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Kategori;
use Validator;
use Storage;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produk = Produk::paginate(2);
        $kategori = Kategori::all();
        $filterKeyword = $request->get('keyword');
        $nama_kategori ='';
        if($filterKeyword)
        {
            $produk = Produk::where('nama_produk','LIKE',"%$filterKeyword%")->paginate(2);
        }

        $filter_by_kategori = $request->get('kd_kategori');
        if($filter_by_kategori){
            $produk = Produk::where('kd_kategori',$filter_by_kategori)->paginate(2);
            $data_kategori = Kategori::find($filter_by_kategori);
            $nama_kategori = $data_kategori->kategori;
        }

        return view('produk.index',compact('produk','kategori','nama_kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view ('produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input,[
            'nama_produk'=>'required|max:255',
            'kd_kategori'=>'required',
            'harga'=>'required|numeric',
            'gambar_produk'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->route('produk.create')->withErrors($validator)->withInput();
        }
        if($request->hasFile('gambar_produk'))
        {
            $destination_path = 'public/images/produk';
            $image = $request -> file('gambar_produk');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('gambar_produk')->storeAs($destination_path, $image_name);
            $input['gambar_produk'] = $image_name;
        }

        $input['stok'] = 100;

        Produk::create($input);
        return redirect()->route('produk.index')->with('success','Produk Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::all();
        $produk = Produk::findOrFail($id);
        return view ('produk.edit', compact('kategori','produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $input = $request->all();

        $validator = Validator::make($input,[
            'nama_produk'=>'required|max:255',
            'kd_kategori'=>'required',
            'harga'=>'required|numeric',
            'gambar_produk'=>'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->route('produk.edit',[$id])->withErrors($validator);
        }

        if($request -> hasFile('gambar_produk')){
            if($request->file('gambar_produk')->isValid());
            {
                Storage::disk('public')->delete($produk->gambar_produk);

                $destination_path = 'public/images/produk';
                $image = $request -> file('gambar_produk');
                $image_name = $image->getClientOriginalName();
                $path = $request->file('gambar_produk')->storeAs($destination_path, $image_name);
                $input['gambar_produk'] = $image_name;
            }
        }

        $produk->update($input);
        return redirect()->route('produk.index')->with('success','Produk Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Produk::findOrFail($id);
        $data->delete();
        return redirect()->route('produk.index')->with('success','Berhasil di Hapus');
    }
}
