<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanApiController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::all();
        $data = array();

        foreach ($kegiatan as $item) {
            $data[] = [
                "id" => $item->id,
                "ukm_id"=>$item->ukm_id,
                "nama_kegiatan" => $item->nama_kegiatan,
                "slug" => $item->slug,
                "tgl_kegiatan" => $item->tgl_kegiatan,
                "deskripsi" => $item->deskripsi,
                "file" => $item->file,
                "nama_ukm" => $item->ukm->nama_ukm,
            ];
        }
        return response()->json(['message'=>'success','data'=>$data]);
    }
    public function show($id)
    {
        $kegiatan = Kegiatan::find($id);
        return response()->json(['message'=> 'success','data'=>$kegiatan]);
    }
    public function store(Request $request)
    {
        $kegiatan = Kegiatan::create($request->all());
        return response()->json(['message'=> 'success','data'=>$kegiatan]);
    }
    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::find($id);
        $kegiatan->update($request->all());
        return response()->json(['message'=> 'success','data'=>$kegiatan]);
    }
    public function destroy($id)
    {
        $kegiatan = Kegiatan::find($id);
        $kegiatan->delete();
        return response()->json(['message'=>'data berhasil dihapus', 'data'=>[]]);
    }
}
