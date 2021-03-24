<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Arr;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pegawai = Pegawai::paginate(3);
        $filterKeyword = $request->get('keyword');
        if($filterKeyword){
            $pegawai = Pegawai::where('nama_pegawai','LIKE', "%$filterKeyword%")->paginate(3);
        }
        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'username' => 'required|max:100|unique:pegawai',
            'password' => 'required|max:6|max:32',
            'nama_pegawai' => 'required|max:100',
            'alamat' => 'required|max:100|'
        ]);
        if($validator->fails()){
            return redirect()->route('pegawai.create')->withErrors($validator)->withInput();
        }

        $data['password'] = password_hash($request->input('password'), PASSWORD_DEFAULT);

        Pegawai::create($data);
        return redirect()->route('pegawai.index')->with('success','Pegawai Ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response 
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $data = $request->all();

        $validasi = Validator::make($data,[
            'password'=>'sometimes|nullable|min:6|max:50',
            'nama_pegawai'=>'required|max:255',
            'alamat'=>'required|max:255'
        ]);

        if($validasi->fails()){
            return redirect()->route('pegawai.edit',[$id])->withErrors($validasi);
        }

        if($request->input('password'))
        {
            $data['password'] = password_hash($request->input('password'), PASSWORD_DEFAULT);
        }
        else
        {
            $data = Arr::except($data,['password']);
        }

        $pegawai->update($data);
        return redirect()->route('pegawai.index')->with('success','Pegawai Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pegawai::findOrFail($id);
        $data->delete();
        return redirect()->route('pegawai.index')->with('success','Berhasil di Hapus');
    }
}
