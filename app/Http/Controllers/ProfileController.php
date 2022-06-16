<?php

namespace App\Http\Controllers;

use App\Models\UKM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

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
        $users= DB::select("CALL `allUser`()");
        $count = User::count();
        $title = 'Profile | All User';
        return view('dashboard.profile.all',compact('users','count','title'));
    }

    public function show()
    {

        $user = User::with(['ukm'])->firstWhere('name',request('user'));
        return view('dashboard.profile.show',[
            'title'=> 'Profile | User ' . request('user'),
            'user'=>$user,
            'ukms'=> UKM::all()
        ]);
    }

    public function update(Request $request)
    {
            DB::beginTransaction();

            $messages =[
                'required'=>'Data tidak boleh kosong',
                'min'=>'Minimal :min karakter',
                'max'=>'Maksimal :max',
                'foto.max'=>'Maksimal :max mb',
                'string'=>'Hanya boleh string'
            ];

            $dataValid = $request->validate([
                'name'=>'required|min:3|max:255|string',
                'email'=>'required',
                'ukm_id'=>'required',
                'role'=>'required',
                'foto'=>'image|mimes:png,jpg,jpeg|max:5000',
                'tlp'=>'required',
                'password'=>'required|min:5'
            ],$messages);
            $hashing=Hash::check($request->pw_lama,$request->oldPassword);
            if ($hashing === FALSE) {
                // return redirect()->back()->with('errorPassword','message');
                Session::flash('errorPassword','Password tidak cocok');
                return redirect()->back();
            }
            $path='user-image';
            $requestFile=$request->file('foto');


            if($hashing)
            {
                if ($requestFile) {
                    if ($request->oldImage) {
                        // delete image
                       Storage::delete($request->oldImage);
                    }
                    $dataValid['foto'] = $requestFile->store($path);
                    // upload image
                }

            }else {
                return redirect()->back()->with('error','errorMessage');
            }
            $dataValid['password'] = Hash::make($request->password);
            DB::table('users')->where('id',$request->id)->update($dataValid);
            DB::commit();
            return response()->json(['status'=>1,'msg'=>'Profile berhasil diupdate!']);
        }
    }
