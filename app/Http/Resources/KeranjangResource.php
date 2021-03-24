<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KeranjangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'kd_keranjang'=>$this->kd_keranjang,
            'username'=>$this->username,
            'kd_produk'=>$this->kd_produk,
            'jumlah'=>$this->jumlah,
            'harga'=>$this->harga,
            'nama_produk'=>$this->produk->nama_produk,
            'kategori'=>$this->produk->kategori->kategori,
            'gambar_produk'=>"/public/uploads/produk/".$this->produk->gambar_produk
        ];
    }
}
