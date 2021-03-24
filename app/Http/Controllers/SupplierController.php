<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $supplier = Supplier::paginate(4);
        $filterKeyword = $request->get('keyword');
        if($filterKeyword){
            $supplier = Supplier::where('nama_supplier', 'LIKE', "%$filterKeyword%")->paginate(2);
        }
        return view('supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
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

        $validasi = Validator::make($data, [
            'nama_supplier' => 'required|max:100',
            'alamat_supplier' => 'required|max:100'
        ]);
        if($validasi->fails())
        {
            return redirect()->route('supplier.create')->withInput()->withErrors($validasi);
        }
        Supplier::create($data);
        return redirect()->route('supplier.index')->with('success', 'Supplier ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $supplier = Supplier::findOrFail($id);
        // return view('supplier.detail', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $data = $request->all();

        $validasi = Validator::make($data,[
            'nama_supplier'=>'required|max:255',
            'alamat_supplier'=>'required|max:255'
        ]);

        if($validasi->fails()){
            return redirect()->route('supplier.edit',[$id])->withErrors($validasi);
        }

        $supplier->update($data);
        return redirect()->route('supplier.index')->with('success','Supplier Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Supplier::findOrFail($id);
        $data->delete();
        return redirect()->route('supplier.index')->with('success','Supplier dihapus');
    }
}
