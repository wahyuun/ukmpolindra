<?php

namespace App\Http\Controllers;

use App\Models\UKM;
use App\Models\Kegiatan;
use App\Models\Proposal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index',[
            'title'=>'Dashboard',
            'ukms'=>UKM::all()->sortDesc()
        ]);
    }

}
