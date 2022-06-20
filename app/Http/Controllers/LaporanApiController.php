<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanApiController extends Controller
{
    public function index()
    {
        $laporan = Laporan::all();
        $data = array();

        foreach ($laporan as $item) {
            $data[] = [
                "id" => $item->id,
                "nama_laporan" => $item->nama_laporan,
                "tgl_laporan" => $item->tgl_laporan,
                "keterangan" => $item->keterangan,
                "file" => $item->file,
                "ukm_id"=>$item->ukm_id,
                "kegiatan_id"=>$item->ukm_id,
                "nama_kegiatan" => $item->kegiatan->nama_kegiatan,
                "nama_ukm" => $item->ukm->nama_ukm,
            ];
        }
        return response()->json(['message'=>'success','data'=>$data]);
    }
    public function show($id)
    {
        $laporan = Laporan::find($id);
        return response()->json(['message'=> 'success','data'=>$laporan]);
    }
    public function store(Request $request)
    {
        $laporan = Laporan::create($request->all());
        return response()->json(['message'=> 'success','data'=>$laporan]);
    }
    public function update(Request $request, $id)
    {
        $laporan = Laporan::find($id);
        $laporan->update($request->all());
        return response()->json(['message'=> 'success','data'=>$laporan]);
    }
    public function destroy($id)
    {
        $laporan = Laporan::find($id);
        $laporan->delete();
        return response()->json(['message'=>'data berhasil dihapus', 'data'=>[]]);
    }
}
