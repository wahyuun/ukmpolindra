<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;

class LogbookApiController extends Controller
{
    public function index()
    {
        $logbook = Logbook::all();
        $data = array();

        foreach ($logbook as $item) {
            $data[] = [
                "id" => $item->id,
                "progress" => $item->progress,
                "tgl_logbook" => $item->tgl_logbook,
                "uraian" => $item->uraian,
                "hasil" => $item->hasil,
                "kendala" => $item->kendala,
                "kegiatan_id" => $item->kegiatan_id,
                "nama_kegiatan" => $item->kegiatan->nama_kegiatan,
                "ukm_id" => $item->ukm_id,
                "nama_ukm" => $item->ukm->nama_ukm,
            ];
        }
        return response()->json(['message'=>'success','data'=>$data]);
    }
    public function show($id)
    {
        $logbook = Logbook::find($id);
        return response()->json(['message'=> 'success','data'=>$logbook]);
    }
    public function store(Request $request)
    {
        $logbook = Logbook::create($request->all());
        return response()->json(['message'=> 'success','data'=>$logbook]);
    }
    public function update(Request $request, $id)
    {
        $logbook = Logbook::find($id);
        $logbook->update($request->all());
        return response()->json(['message'=> 'success','data'=>$logbook]);
    }
    public function destroy($id)
    {
        $logbook = Logbook::find($id);
        $logbook->delete();
        return response()->json(['message'=>'data berhasil dihapus', 'data'=>[]]);
    }
}
