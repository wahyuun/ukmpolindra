<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalApiController extends Controller
{
    public function index()
    {
        $Proposal = Proposal::all();
        $data = array();

        foreach ($Proposal as $item) {
            $data[] = [
                "id" => $item->id,
                "nama_proposal" => $item->nama_proposal,
                "tgl_proposal" => $item->tgl_proposal,
                "keterangan" => $item->keterangan,
                "status" => $item->status,
                "komentar" => $item->komentar,
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
        $Proposal = Proposal::find($id);
        return response()->json(['message'=> 'success','data'=>$Proposal]);
    }
    public function store(Request $request)
    {
        $Proposal = Proposal::create($request->all());
        return response()->json(['message'=> 'success','data'=>$Proposal]);
    }
    public function update(Request $request, $id)
    {
        $Proposal = Proposal::find($id);
        $Proposal->update($request->all());
        return response()->json(['message'=> 'success','data'=>$Proposal]);
    }
    public function destroy($id)
    {
        $Proposal = Proposal::find($id);
        $Proposal->delete();
        return response()->json(['message'=>'data berhasil dihapus', 'data'=>[]]);
    }
}
