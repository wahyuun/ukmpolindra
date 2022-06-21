<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalApiController extends Controller
{
    public function __construct(){
        $this->Hashids = new \Hashids\Hashids( env('MY_SECRET_SALT_KEY','MySecretSalt') );
    }

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
        // cara mengembalikan id yg telah di hash
        $url_id = $this->Hashids->decode($id)[0];
        $proposal = Proposal::find($url_id);
        $proposal->update($request->all());
        return response()->json(['message'=> 'success','data'=>$proposal]);
    }
    public function destroy($id)
    {
        $Proposal = Proposal::find($id);
        $Proposal->delete();
        return response()->json(['message'=>'data berhasil dihapus', 'data'=>[]]);
    }
}
