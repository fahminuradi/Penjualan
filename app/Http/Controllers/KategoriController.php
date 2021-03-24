<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kategori;
use Storage;
use Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kategori = Kategori::paginate(2);
        $filterKeyword = $request->get('keyword');

        if($filterKeyword){
            $kategori = Kategori::where('kategori', 'LIKE', "%$filterKeyword%")->paginate(2);
        }

        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
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
            'kategori' => 'required|max:255',
            'gambar_kategori' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->route('kategori.create')->withErrors($validator)->withInput();
        }

        if($request->hasFile('gambar_kategori'))
        {
            $destination_path = 'public/images/kategori';
            $image = $request -> file('gambar_kategori');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('gambar_kategori')->storeAs($destination_path, $image_name);
            $input['gambar_kategori'] = $image_name;
        }
        

        Kategori::create($input);
        return redirect()->route('kategori.index')->with('status','Kategori Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit',compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $input = $request->all();

        $validator = Validator::make($input,[
            'kategori'=>'required|max:255',
            'gambar_kategori'=>'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->route('kategori.edit',[$id])->withErrors($validator);
        }

        if($request -> hasFile('gambar_kategori')){
            if($request->file('gambar_kategori')->isValid());
            {
                Storage::disk('public')->delete($kategori->gambar_kategori);

                $destination_path = 'public/images/kategori';
                $image = $request -> file('gambar_kategori');
                $image_name = $image->getClientOriginalName();
                $path = $request->file('gambar_kategori')->storeAs($destination_path, $image_name);
                $input['gambar_kategori'] = $image_name;
            }
        }
        $kategori->update($input);
        return redirect()->route('kategori.index')->with('success','Kategori Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kategori::findOrFail($id);
        $data->delete();
        return redirect()->route('kategori.index')->with('success','Berhasil di Hapus');
    }
}
