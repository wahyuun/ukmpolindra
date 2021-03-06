<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Logbook;
use App\Models\Proposal;
use App\Models\UKM;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function __construct(){
        $this->Hashids = new \Hashids\Hashids( env('MY_SECRET_SALT_KEY','MySecretSalt') );
    }

    public function index(){
        //robotika
        $ukm = UKM::firstWhere('slug','robotika-polindra');
        $ukmId = $ukm->id;
        $rpi = Logbook::with(['kegiatan','ukm'])->where('ukm_id',$ukmId)->count();
        //sebura
        $ukm = UKM::firstWhere('slug','seni-budaya-polindra');
        $ukmId = $ukm->id;
        $sebura = Logbook::with(['kegiatan','ukm'])->where('ukm_id',$ukmId)->count();
        //kompa
        $ukm = UKM::firstWhere('slug','komunitas-mahasiswa-pecinta-alam');
        $ukmId = $ukm->id;
        $kompa = Logbook::with(['kegiatan','ukm'])->where('ukm_id',$ukmId)->count();
        //Folafo
        $ukm = UKM::firstWhere('slug','foreign-language-forum');
        $ukmId = $ukm->id;
        $folafo = Logbook::with(['kegiatan','ukm'])->where('ukm_id',$ukmId)->count();
        //Popi
        $ukm = UKM::firstWhere('slug','persatuan-olahraga-polindra');
        $ukmId = $ukm->id;
        $popi = Logbook::with(['kegiatan','ukm'])->where('ukm_id',$ukmId)->count();
        //Menwa
        $ukm = UKM::firstWhere('slug','resimen-mahasiswa');
        $ukmId = $ukm->id;
        $menwa = Logbook::with(['kegiatan','ukm'])->where('ukm_id',$ukmId)->count();
        //Formadiksi
        $ukm = UKM::firstWhere('slug','forum-mahasiswa-bidik-misi');
        $ukmId = $ukm->id;
        $formadiksi = Logbook::with(['kegiatan','ukm'])->where('ukm_id',$ukmId)->count();
        //Kopen
        $ukm = UKM::firstWhere('slug','kotak-pena');
        $ukmId = $ukm->id;
        $kopen = Logbook::with(['kegiatan','ukm'])->where('ukm_id',$ukmId)->count();
        //All
        $all = Logbook::with(['kegiatan','ukm'])->count();
        return view('dashboard.logbook.index',[
            'title'=>'Logbook Kegiatan',
            'rpi'=>$rpi,
            'sebura'=>$sebura,
            'kompa'=>$kompa,
            'folafo'=>$folafo,
            'popi'=>$popi,
            'menwa'=>$menwa,
            'formadiksi'=>$formadiksi,
            'kopen'=>$kopen,
            'all'=>$all
        ]);
    }

    public function show()
    {
        // cara mengembalikan id yg telah di hash
        $url_id = $this->Hashids->decode(request('detail'))[0];
        if (request('detail')) {
            $logbook = Logbook::with(['ukm','kegiatan'])->find($url_id);
        }
        return view('dashboard.logbook.show',[
            'title'=> 'Proposal | Detail Logbook',
            'logbook'=>$logbook
        ]);
    }

    public function delLogbook()
    {


        if (request('delete')) {
            // cara mengembalikan id yg telah di hash
            $url_id = $this->Hashids->decode(request('delete'))[0];
        }
        Logbook::destroy($url_id);
        return redirect()->back()->with('delete_success','message');
    }


    // Dashboard data logbook
    public function swLogbook()
    {
        $ukm = UKM::firstWhere('slug',request('detail'));
        $ukmId=$ukm->id;

        $logbook = Logbook::with(['kegiatan','ukm'])->where('ukm_id',$ukmId)->get();
        return view('dashboard.showLogbook',[
        'title' => 'Detail Logbook | ' . request('detail'),
        'logbook'=>$logbook,
        'ukm'=>$ukm
        ]);
    }



    public function data_logbook(){
        $activity = Logbook::select([
            'logbooks.id','logbooks.tgl_logbook','logbooks.uraian','logbooks.progress','logbooks.hasil','logbooks.kegiatan_id','logbooks.kendala','logbooks.created_at','logbooks.ukm_id','logbooks.updated_at'])->with(['kegiatan','ukm']);
            return DataTables::of($activity)
            // edit kolom status
            ->editColumn('progress',function($progress){
                if($progress->progress == 0){
                    return '<p class="badge bg-danger">Gagal</p>';
                }elseif ($progress->progress == 1) {
                    return '<p class="badge bg-success">Sukses</p>';
                }
                elseif ($progress->progress == 2) {
                    return '<p class="badge bg-warning">Sedang berjalan</p>';
                }
            })
            ->addColumn('action', function($data){
                $url_show = url('/lg-detailLogbook?detail='.$data->id);
                $url_delete = url('/lg-deleteLogbook?delete='.$data->id);
                $varUKM = $data->ukm->status;
                if ($varUKM != 0) {
                    '<div class="dropdown">'.
                    $button = '<a class="text-muted">
                    <div class="col-auto">
                    <div class="dropdown">
                    <a href="#" class="btn-action" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="1" /><circle cx="12" cy="19" r="1" /><circle cx="12" cy="5" r="1" /></svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                    <a href="'.$url_show.'" class="dropdown-item">Detail</a>
                    <a href="#" class="dropdown-item">Export PDF</a>
                    <a href="'.$url_delete.'" class="dropdown-item text-danger logbook-delete">Delete</a>
                    </div>
                    </div>
                    </div>
                    </a>
                    </div>';

                }else {
                    $button = '<span class="text-danger" title="Akses terkunci"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                    <circle cx="12" cy="16" r="1"></circle>
                    <path d="M8 11v-4a4 4 0 0 1 8 0v4"></path>
                    </svg></span>';
                }
                return $button;
            })
            ->editColumn('uraian',function($request){
                // untuk memotong kalimat. search : string helpers. strip_tags adalah method untuk menghilangkan tag html
                $varWrap = Str::limit(strip_tags($request->uraian), 30);
                return $varWrap;
            })
            ->editColumn('hasil',function($request){
                // untuk memotong kalimat. search : string helpers. strip_tags adalah method untuk menghilangkan tag html
                $varWrap = Str::limit(strip_tags($request->hasil), 30);
                return $varWrap;
            })
            ->editColumn('kendala',function($request){
                // untuk memotong kalimat. search : string helpers. strip_tags adalah method untuk menghilangkan tag html
                $varWrap = Str::limit(strip_tags($request->kendala), 30);
                return $varWrap;
            })
            ->editColumn('created_at',function($created){
                $dibuat = \Carbon\Carbon::parse($created->created_at)->isoFormat('dddd, DD MMMM Y HH:mm:ss a');
                return $dibuat;
            })
            ->editColumn('updated_at',function($updated){
                $diubah = \Carbon\Carbon::parse($updated->created_at)->isoFormat('dddd, DD MMMM Y HH:mm:ss a');
                return $diubah;
            })
            ->rawColumns(['action','tgl_logbook','progress','ukm'])
            ->make(true);
        }

    }
