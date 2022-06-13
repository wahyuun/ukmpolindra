<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class ProfileController extends Controller
{
    public function __construct(){
        $this->Hashids = new \Hashids\Hashids( env('MY_SECRET_SALT_KEY','MySecretSalt') );
    }

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
        // cara mengembalikan id yg telah di hash
        $url_id = $this->Hashids->decode(request('user'))[0];
        $user = User::find($url_id);
        return view('dashboard.profile.show',[
            'title'=> 'Profile | User ' . request('user'),
            'user'=>$user
        ]);
    }
}
