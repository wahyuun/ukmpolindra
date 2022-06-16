@extends('dashboard.layouts.main')
@section('container')
<div class="page-wrapper">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mb-1">
                        <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('profile') }}">Profile & Acoount</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Seluruh User</a></li>
                        </ol>
                    </div>
                    <div class="text-muted mt-1">{{ $count }} user</div>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Cari disini..."/>
                        <a href="#" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                <path d="M16 11h6m-3 -3v6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Session::get('success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Profil berhasil diubah',
            showConfirmButton: false,
            timer: 2000
        })
    </script>
    @endif
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                @foreach($users as $user)
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <a href="{{ url('/profile/show?user='.$user->name ?? '') }}" class="text-decoration-none">
                            <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url({{ $user->foto ? asset('storage/'.$user->foto) : asset('img/noprofil.png') }})">
                                    @if($user->active_status == 1)
                                    <div class="col-auto align-self-center">
                                        <div class="badge bg-success"></div>
                                    </div>
                                    @endif
                                </span>
                                <h3 class="m-0 mb-1 navbar-brand-autodark">{{ strtoupper($user->name) }}</h3>
                                <div class="text-muted">{{ strtolower($user->email) }}</div>
                                <div class="mt-3">
                                    @if($user->role==1)
                                    <span class="badge bg-purple-lt">Kemahasiswaan</span>
                                    @elseif($user->role==2)
                                    <span class="badge bg-green-lt">BAAK</span>
                                    @elseif($user->role==3)
                                    <span class="text-muted">
                                        @if($user->ukm_id === NULL)
                                        UKM
                                        @else
                                        {{ $user->ukm->nama_ukm }}
                                        @endif
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                        <div class="d-flex">
                            <a href="https://mail.google.com/mail/{{ strtolower($user->email) }}" class="card-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="5" width="18" height="14" rx="2" /><polyline points="3 7 12 13 21 7" /></svg>
                                Email</a>
                                <a href="{{ $user->tlp }}" class="card-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                    Telepon</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endsection
