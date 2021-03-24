<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AgenResource;
use App\Agen;
use Validator;
use Storage;

class AgenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AgenResource::collection(Agen::all());
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
            'nama_toko'=>'required|max:255',
            'nama_pemilik'=>'required|max:255',
            'alamat'=>'required|max:255',
            'latitude'=>'required|max:255',
            'longitude'=>'required|max:255',
            'gambar_toko'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validator->fails()){
            return response()->json([
                "status"=>FALSE,
                "msg"=>$validator->errors()
            ],400);
        }

        if($request->hasFile('gambar_toko'))
        {
            $destination_path = 'public/images/toko';
            $image = $request -> file('gambar_toko');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('gambar_toko')->storeAs($destination_path, $image_name);
            $input['gambar_toko'] = $image_name;
        }

        if(Agen::create($input)){
            //memberikan response berhasil
            return response()->json([
                'status'=>TRUE,
                'msg'=>'Agen Berhasil disimpan'
            ],201);
        }
        else
        {
            //memberikan response gagal
            return response()->json([
                'status'=>FALSE,
                'msg'=>'Agen Gagal disimpan'
            ],200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agen = Agen::find($id);
        if(is_null($agen)){
            return response()->json([
                "status"=>FALSE,
                "msg"=>'Record Not Found'
            ],404);
        }

        return new AgenResource($agen);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $agen = Agen::find($id);
        if(is_null($agen))
        {
            return response()->json([
                'status'=>FALSE,
                'msg'=>'Record Not Found',
            ],404);
        }

        $validator = Validator::make($input,[
            'nama_toko'=>'required|max:255',
            'nama_pemilik'=>'required|max:255',
            'alamat'=>'required|max:255',
            'latitude'=>'required|max:255',
            'longitude'=>'required|max:255',
            'gambar_toko'=>'sometimes|image|mimes:jpeg,jpg,png|max:2048'
        ]);


        if($validator->fails()){
            return response()->json([
                "status"=>FALSE,
                "msg"=>$validator->errors()
            ],400);
        }

        if($request -> hasFile('gambar_toko')){
            if($request->file('gambar_toko')->isValid());
            {
                Storage::disk('public')->delete($produk->gambar_toko);

                $destination_path = 'public/images/produk';
                $image = $request -> file('gambar_toko');
                $image_name = $image->getClientOriginalName();
                $path = $request->file('gambar_toko')->storeAs($destination_path, $image_name);
                $input['gambar_toko'] = $image_name;
            }
        }

        $agen->update($input);
        return response()->json([
            'status'=>TRUE,
            'msg'=>'Data Berhasil diupdate'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agen = Agen::find($id);
        if(is_null($agen))
        {
            return response()->json([
                'status'=>FALSE,
                'msg'=>'Record Not Found',
            ],404);
        }

        $agen->delete();
        return response()->json([
            'status'=>TRUE,
            'msg'=>'Data Berhasil dihapus',
        ],200);
    }

    public function search(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        return AgenResource::collection(Agen::where('nama_toko','LIKE',"%$filterKeyword%")->get());
    }
}
