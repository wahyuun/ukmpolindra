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
                'foto.max'=>'Maksimal :max',
                'string'=>'Hanya boleh string'
            ];

            $dataValid = $request->validate([
                'name'=>'required|min:3|max:255|string',
                'email'=>'required|email:dns',
                'ukm_id'=>'required',
                'role'=>'required',
                'foto'=>'image|max:5000',
                'tlp'=>'',
                'password'=>'min:5',
                'remember_token'=>'required'
            ],$messages);

            // Password
            $hashing=Hash::check($request->pw_lama,$request->oldPassword);
            if (!$hashing) {
                Session::flash('errorPassword','Password tidak cocok');
                return redirect()->back();
            }else {
                $dataValid['password'] = Hash::make($request->password);
            }

            // Image
            if ($request->file('foto') ) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                    // search saja file storage => the public disk
                }
                $dataValid['foto'] = $request->file('foto')->store('user-image');
            }

            DB::table('users')->where('id',$request->id)->update($dataValid);
            DB::commit();
            // return response()->json(['status'=>1,'msg'=>'Profile berhasil diupdate!']);
            Session::flash('success','Profil berhasil diupdate');
            return redirect()->route('all');
        }


        // public function updateFoto(Request $request){

            // $path = 'storage/user-image/';
            // $file = $request->file('foto');
            // $new_image_name = 'UIMG'.date('Ymd').uniqid().'.jpg';
            // $upload = $file->move(public_path($path), $new_image_name);

            // if($upload){
            //     // return response()->json(['status'=>1, 'msg'=>'Image has been cropped successfully.', 'name'=>$new_image_name]);
            //     $userInfo = User::firstWhere('id','=',$request->id);
            //     $userPhoto = $userInfo->foto;
            //     if ($userPhoto !='') {
            //         unlink($path.$userPhoto);
            //     }
            //     // Update foto field in database
            //     User::find(Auth::user()->id)->update(['foto'=>$new_image_name]);
            //     Session::flash('success-profile','Foto berhasil diu');
            //     return redirect()->back();

            // }else{
            //       return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);
            // }

            // DB::beginTransaction();

            // $messages = [
            //     'foto.max'=>'Maksimal :max mb',
            //     'foto.mimes'=>'File harus berupa :values'
            // ];
            // $validatedImage = $request->validate([
            //     'foto'=>'mimes:png,jpg,jpeg|max:5000|image'
            // ],$messages);

            // $path='user-image';
            // $requestFile=$request->file('foto');

            // if ($requestFile) {
            //     if ($request->oldImage) {
            //         // delete image
            //        Storage::delete($request->oldImage);
            //     }
            //     // save image in local
            //     $requestFile->store($path);
            //     User::where('id',$request->id)->update([
            //         'foto'=>$requestFile
            //     ]);
            //     Session::flash('success-profile','Foto berhasil diu');
            //     return redirect()->back();
            // }
            // DB::table('users')->where('id',$request->id)->update([
            //     'foto'=> $validatedImage
            // ]);
            // DB::commit();


    //         $path = 'storage/user-image/';
    // $file = $request->file('foto');
    // $new_name = 'PFP_'.date('dmY').uniqid().'.jpg';
    // //Upload new image
    // $upload = Storage::putFileAs($path, $file, $new_name);
    // if( !$upload ){
    //     return response()->json(['status'=>0,'msg'=>'Something went wrong, upload new picture failed.']);
    // }else{
    //     //Get Old picture
    //     $oldPicture = Storage::get(User::find(auth()->user()->id)->getAttributes()['foto']);

    //     if( $oldPicture != '' ){
    //         if( Storage::disk('s3')->exists($path.$oldPicture)){
    //             Storage::delete($path.$oldPicture);
    //         }
    //     }

    //     //Update DB
    //     $update = User::find(auth()->user()->id)->update(['foto'=>$new_name]);

    //     if( !$update ){
    //         return response()->json(['status'=>0,'msg'=>'Something went wrong, updating picture in db failed.']);
    //     }else{
    //         return response()->json(['status'=>1,'msg'=>'Your profile picture has been updated successfully']);
    //     }
    // }



// }
        // function updateFoto(Request $request){
        //         $path = 'storage/user-image/';
        //         $file = $request->file('foto');
        //         $new_image_name = 'WHY'.date('Ymd').uniqid().'.jpg';

        //         $upload = $file->move(public_path($path), $new_image_name);
        //         if(!$upload){
        //             return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);
        //         }
        //             User::where('id',Auth::user()->id)->update([
        //                 'foto'=>$new_image_name
        //             ]);
        //             // return response()->json(['status'=>0, 'msg'=>'Suksesssss']);


        //     }
    }
