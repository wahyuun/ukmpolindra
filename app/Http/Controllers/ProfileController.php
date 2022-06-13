<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UKM;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index',[
            'title'=> 'Profile | ' . Auth::user()->name
        ]);
    }

    public function all()
    {
        $user = User::all();
        $userCount = User::count();
        return view('dashboard.profile.all',[
            'title'=> 'Profile | User',
            'users'=> $user,
            'count'=>$userCount
        ]);
    }

    public function show()
    {

        $user = User::firstWhere('name',request('user'));
        return view('dashboard.profile.show',[
            'title'=> 'Profile | User ' . request('user'),
            'user'=>$user,
            'ukms'=> UKM::all()
        ]);
    }
}
