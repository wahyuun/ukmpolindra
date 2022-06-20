@extends('dashboard.layouts.main')
@section('container')

<div class="page-body">
    <div class="container-xl">
        <div class="page-header mb-4">
            <div class="row align-items-center mw-100">
                <div class="col">
                    <div class="mb-1">
                        <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                            <li class="breadcrumb-item " aria-current="page"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ $ukm->nama_ukm }}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card card-lg">
                    <div class="card-body markdown">
                        @if($ukm->logo)
                        <img src="{{ asset('storage/'.$ukm->logo) }}" alt="{{ $ukm->nama_ukm }}" class="col-5 mb-3 img-fluid mx-auto d-block rounded-circle" style="height:200px; width:200px;" title="{{ $ukm->slug }}">
                        @else
                        <img src="img/noimage.png" alt="No Image Preview" class="col-5 mb-3 img-fluid mx-auto d-block rounded-circle" title="No Image Preview">
                        @endif
                        <h1 id="whos-that-then" class="text-center">{{ $ukm->nama_ukm }}</h1>
                        <p>{!! $ukm->deskripsi !!}</p>
                        <hr>
                        <h2>File</h2>
                        <a href="{{ asset('storage/'.$ukm->file) }}"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
