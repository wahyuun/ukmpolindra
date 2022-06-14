@extends('dashboard.layouts.main')
@section('container')
<div class="page-body">
    <div class="container-xl">
        <div class="page-header">
            <div class="row align-items-center mw-100">
                <div class="col">
                    <div class="mb-1">
                        <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Profile & Acoount</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-8 col-md-4 mx-auto my-auto">
    <div class="card">
        <div class="page-pretitle mt-3 text-end">
            <div class="dropdown" title="Status action" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <a
                class="me-3"
                href="#"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg></a>
                <div
                class="dropdown-menu dropdown-menu-end">
                <a href="" class="dropdown-item text-green">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        <path d="M16 11h6m-3 -3v6"></path>
                     </svg>
                     Tambah User</a>
                <div class="dropdown-divider"></div>
                <a href="{{ url('/profile/all-user?all=user') }}" class="dropdown-item text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                    </svg>
                    Seluruh User</a>
                </div>
            </div>
        </div>

        <div class="card-body text-center">
            <div class="mb-3">
                <span class="avatar avatar-xl avatar-rounded" style="background-image: url({{ Auth::user()->foto ? asset('storage/'.Auth::user()->foto) : asset('img/noprofil.png') }})"></span>
            </div>
            <div class="card-title mb-1">{{ Auth::user()->name }}</div>
            <div class="text-muted">{{ Auth::user()->email }}</div>
            <div class="mt-3">
                @if(Auth::user()->role == 1)
                <span class="badge bg-purple-lt">Kemahasiswaan</span>
                @elseif(Auth::user()->role == 2)
                <span class="badge bg-green-lt">BAAK</span>
                @elseif(Auth::user()->role == 3)
                <span class="text-muted">UKM</span>
                @endif
            </div>
        </div>
        <div class="d-flex">
            <a target="_blank" href="https://mail.google.com/mail/{{ Auth::user()->email }}" class="card-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="5" width="18" height="14" rx="2" /><polyline points="3 7 12 13 21 7" /></svg>
                Email</a>
                <a target="_blank" href="{{ Auth::user()->tlp }}" class="card-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                    Telepon
                </a>
            </div>
            <a href="#" class="card-btn">Tampilkan</a>
        </div>
    </div>
    @endsection
