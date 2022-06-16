@extends('dashboard.layouts.main')
@section('container')
<style>
    #toggle_lama{
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        width: 30px;
        height: 30px;
        background: url(../../../img/show.png);
        background-size: cover;
        cursor: pointer;
    }
    #toggle_lama.hide{
        background: url(../../../img/hide.png);
        background-size: cover;
    }

    #toggle_baru{
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        width: 30px;
        height: 30px;
        background: url(../../../img/show.png);
        background-size: cover;
        cursor: pointer;
    }
    #toggle_baru.hide{
        background: url(../../../img/hide.png);
        background-size: cover;
    }
</style>
<div class="page-body">
    <div class="container-xl">
        <div class="page-header">
            <div class="row align-items-center mw-100">
                <div class="col">
                    <div class="mb-1">
                        <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('profile') }}">Profile & Acoount</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('all') }}">Seluruh User</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#"><span class="fw-bold">{{ strtoupper($user->name ? $user->name :'') }}</span></a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @if(Session::has('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Gagal menambahkan!'
            })
        </script>
        @endif
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('profile-update') }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    @if(empty($user->foto))
                    <span class="avatar avatar-xl mb-3 avatar-rounded d-block mx-auto"><img src="{{ asset('img/noprofil.png') }}" class="img-preview rounded-circle avatar-rounded avatar avatar-xl">
                        <div class="col-auto align-self-center">

                            {{-- <div class="badge" style="width: 0px; height:45px;  margin-bottom:-7px; margin-right:-8px;">
                                <svg style="font-size: 30px; margin-left: -9px; margin-bottom:10px;" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="15" y1="8" x2="15.01" y2="8"></line>
                                    <rect x="4" y="4" width="16" height="16" rx="3"></rect>
                                    <path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5"></path>
                                    <path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2"></path>
                                </svg>
                            </div> --}}
                            <div>
                                <input id="foto" name="foto" type="file" class="foto form-control badge bg-danger" style="background-color: transparent;" onchange="previewImage()"/>
                            </div>
                        </div>
                    </span>
                    @else
                    <span class="avatar avatar-xl mb-3 avatar-rounded d-block mx-auto"><img src="{{ asset('storage/'.$user->foto) }}" class="img-preview rounded-circle avatar-rounded avatar avatar-xl"> </span>
                    @endif
                    <fieldset class="form-fieldset">
                        <h3>User Acoount Manajement</h3>
                        @if($message=Session::get('errorPassword'))
                        <script>
                            Swal.fire({
                                title: 'Password Tidak Cocok',
                                timer: 2000,
                                icon: 'error',
                                showConfirmButton: false,
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                        </script>
                        {{-- <div class="alert alert-danger auto-close">{{ $message }}</div> --}}
                        @endif
                        <div class="form-floating mb-3">
                            <input name="name" type="text" class="form-control" id="floating-input" value="{{ old('name',$user->name) }}">
                            <label for="floating-input">Nama Lengkap</label>
                            @error('name')
                            <div class="alert alert-danger auto-close">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="oldImage" value="{{ $user->foto }}">
                        <input type="hidden" name="oldPassword" value="{{ $user->password }}">
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="form-floating mb-3">
                            <input name="email" type="email" class="form-control" id="floating-input" value="{{ old('email',$user->email) }}" autocomplete="off">
                            <label for="floating-input">Alamat Email</label>
                            @error('email')
                            <div class="alert alert-danger auto-close">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                </svg>
                            </span>
                            <input value="{{ old('tlp',$user->tlp) }}" type="tel" name="tlp" class="form-control" data-mask="(+62) 000-0000-0000" data-mask-visible="true" placeholder="(+62) 0000-0000" autocomplete="off"/>
                            @error('tlp')
                            <div class="alert alert-danger auto-close">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <select name="role" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                @if($user->role == 1)
                                <option value="{{ $user->role }}" selected>Kemahasiswaan</option>
                                @elseif($user->role == 2)
                                <option value="{{ $user->role }}" selected>BAAK</option>
                                @elseif($user->role == 3)
                                <option value="{{ $user->role }}" selected>UKM</option>
                                @endif

                                <option value="1">Kemahasiswaan</option>
                                <option value="2">BAAK</option>
                                <option value="3">UKM</option>
                            </select>
                            <label for="floatingSelect">Akses Aplikasi</label>
                            @error('role')
                            <div class="alert alert-danger auto-close">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <select name="ukm_id" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                @foreach($ukms as $ukm)
                                @if(old('ukm_id',$user->ukm_id) == $ukm->id)
                                <option value="{{ $ukm->id }}" selected>{{ $ukm->nama_ukm }}</option>
                                @else
                                <option value="{{ $ukm->id }}">{{ $ukm->nama_ukm }}</option>
                                @endif
                                @endforeach
                            </select>
                            <label for="floatingSelect">Unit Kegiatan Mahasiswa</label>
                            @error('ukm_id')
                            <div class="alert alert-danger auto-close">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input required type="password" name="pw_lama" class="form-control" id="pw_lama" autocomplete="off">
                            <label for="floating-password">Password Lama</label>
                            <div id="toggle_lama" onclick="showHideLama();"></div>
                        </div>
                        <div class="form-floating mb-3">
                            <input required type="password" value="password" name="password" class="form-control" id="pw_baru" autocomplete="off">
                            <div id="toggle_baru" onclick="showHide();"></div>
                            <label for="floating-password">Password Baru</label>
                        </div>
                        <small class="form-hint" style="margin-top: -10px">
                            *Password minimal 5 karakter
                        </small>
                        @error('password')
                        <div class="alert alert-danger auto-close">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="fw-bold mt-3 btn btn-primary gap-2 col-12">
                            Update Profil
                        </button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // preview Image
    function previewImage() {
        // tangkap ke dalam variabel
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        // merubah display style img
        imgPreview.style.display = 'block';

        // membuat object
        const oFReader = new FileReader();

        oFReader.readAsDataURL(foto.files[0]);

        // ketika di load
        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }

    }
</script>
{{-- password --}}
<script type="text/javascript">
    const password = document.getElementById('pw_lama');
    const toggle = document.getElementById('toggle_lama');

    function showHideLama(){
        if(password.type === 'password'){
            password.setAttribute('type', 'text');
            toggle.classList.add('hide')
        } else{
            password.setAttribute('type', 'password');
            toggle.classList.remove('hide')
        }
    }
</script>
<script type="text/javascript">
    const password_baru = document.getElementById('pw_baru');
    const toggle_baru = document.getElementById('toggle_baru');

    function showHide(){
        if(password_baru.type === 'password'){
            password_baru.setAttribute('type', 'text');
            toggle_baru.classList.add('hide')
        } else{
            password_baru.setAttribute('type', 'password');
            toggle_baru.classList.remove('hide')
        }
    }
</script>

{{-- crop --}}
{{-- <script>
    $('#foto').ijaboCropTool({
        preview : '.foto',
        setRatio: 7/8,
        allowedExtensions: ['jpg', 'jpeg','png'],
        buttonsText:['Simpan','Keluar'],
        buttonsColor:['#30bf7d','#ee5155', -15],
        processUrl:'{{ route("crop") }}',
        withCSRF:['_token','{{ csrf_token() }}'],
        onSuccess:function(message, element, status){
            alert(message);
        },
        onError:function(message, element, status){
            alert(message);
        }

    });
</script> --}}
@endsection
