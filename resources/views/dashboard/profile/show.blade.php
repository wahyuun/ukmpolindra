@extends('dashboard.layouts.main')
@section('container')
<div class="page-body">
    <div class="container-xl">
        <div class="page-header">
            <div class="row align-items-center mw-100">
                <div class="col">
                    <div class="mb-1">
                        <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Profile {{ $user->name }}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                @if(empty($user->foto))
                <span class="avatar avatar-xl mb-3 avatar-rounded d-block mx-auto"><img src="{{ asset('img/noprofil.png') }}" class="img-preview rounded-circle avatar-rounded avatar avatar-xl">
                    <a href="">
                        <div class="col-auto align-self-center">
                            <div class="badge" style="width: 0px; height:45px;">
                                <svg style="font-size: 30px; margin-left: -9px; margin-bottom:10px;" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="15" y1="8" x2="15.01" y2="8"></line>
                                    <rect x="4" y="4" width="16" height="16" rx="3"></rect>
                                    <path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5"></path>
                                    <path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2"></path>
                                </svg>
                                <input id="foto" name="foto" type="file" class="form-control" onchange="previewImage()"/>
                            </div>
                        </div>
                    </a>
                </span>
                @else
                <span class="avatar avatar-xl mb-3 avatar-rounded d-block mx-auto"><img src="{{ asset('storage/'.$user->foto) }}" class="img-preview rounded-circle avatar-rounded avatar avatar-xl"> </span>
                @endif
                <fieldset class="form-fieldset">
                    <h3>User Acoount Manajement</h3>
                    <div class="form-floating mb-3">
                        <input name="name" type="text" class="form-control" id="floating-input" value="{{ old('name',$user->name) }}">
                        <label for="floating-input">Nama Lengkap</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="email" type="email" class="form-control" id="floating-input" value="{{ old('email',$user->email) }}" autocomplete="off">
                        <label for="floating-input">Alamat Email</label>
                    </div>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                            </svg>
                        </span>
                        <input value="{{ old('tlp',$user->tlp) }}" type="tel" name="tlp" class="form-control" data-mask="(+62) 000-0000-0000" data-mask-visible="true" placeholder="(+62) 0000-0000" autocomplete="off"/>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option selected>Level</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="floatingSelect">Level</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option selected>Level</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="floatingSelect">Unit Kegiatan Mahasiswa</label>
                    </div>

                    {{-- <span class="link-danger">* <small class="fst-italic"> (.PNG,.JPG,.JPEG) max:5mb</small>
                    </span>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera-selfie" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2"></path>
                                <path d="M9.5 15a3.5 3.5 0 0 0 5 0"></path>
                                <line x1="15" y1="11" x2="15.01" y2="11"></line>
                                <line x1="9" y1="11" x2="9.01" y2="11"></line>
                            </svg>
                        </span>
                    </div> --}}
                </fieldset>
            </div>
        </div>
    </div>
</div>
<script>
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
@endsection
