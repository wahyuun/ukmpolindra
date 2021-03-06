@extends('dashboard.layouts.main')
@section('container')
<div class="page-body">
    <div class="container-xl">
        <div class="page-header mb-4">
            <div class="row align-items-center mw-100">
                <div class="col">
                    <div class="mb-1">
                        <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Detail Laporan {{ $ukm->nama_ukm }}</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">
                        <span class="mx-auto">Data Laporan {{ $ukm->nama_ukm }}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-table table-responsive p-3">
                    <table class="table" id="myDashboardLaporan">
                        <thead>
                            <tr>
                                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                                <th>#</th>
                                <th scope="col">UKM</th>
                                <th scope="col">Nama Kegiatan</th>
                                <th scope="col">Nama Laporan</th>
                                <th scope="col">Tanggal Laporan</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Tanggal diupload</th>
                                <th scope="col">Tanggal diubah</th>
                                <th scope="col">File</th>
                                <th scope="col"></th>
                            </tr>
                            <caption>
                                Petunjuk
                                <span class="form-help" data-bs-toggle="popover" data-bs-placement="right" data-bs-html="true" data-bs-content="<p>ZIP Code must be US or CDN format. You can use an extended ZIP+4 code to determine address more accurately.</p>
                                    <p class='mb-0'><a href=''>USP ZIP codes lookup tools</a></p>
                                    ">?</span>
                                </caption>
                            </thead>
                            <tbody>
                                @foreach($laporan as $com)
                                <tr>
                                    <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $com->ukm->nama_ukm }}</td>
                                    <td>{{ $com->kegiatan->nama_kegiatan }}</td>
                                    <td>{{ $com->nama_laporan }}</td>
                                    <td>{{ $com->tgl_laporan }}</td>
                                    <td>{{ Str::limit(strip_tags($com->keterangan), 30) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($com->created_at)->isoFormat('dddd, DD MMMM Y HH:mm:ss a') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($com->updated_at)->isoFormat('dddd, DD MMMM Y HH:mm:ss a') }}</td>
                                    <td>{{ $com->file ?? 'data kosong' }}</td>
                                    <td>
                                        @php
                                        $url_show = url('/lp-detailLaporan?detail='.$com->id);
                                        if ($com->ukm->status != 0) {
                                            echo '<div class="dropdown">'.
                                                '<a class="text-muted">
                                                    <div class="col-auto">
                                                        <div class="dropdown">
                                                            <a href="#" class="btn-action" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="1" /><circle cx="12" cy="19" r="1" /><circle cx="12" cy="5" r="1" /></svg>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="'.$url_show.'" class="dropdown-item">Detail</a>
                                                                <a href="#" class="dropdown-item">Export PDF</a>
                                                                <a href="" class="dropdown-item text-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>';
                                        }else {
                                            echo '<span class="text-danger" title="Akses terkunci"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <desc>Download more icon variants from https://tabler-icons.io/i/lock</desc>
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                                                <circle cx="12" cy="16" r="1"></circle>
                                                <path d="M8 11v-4a4 4 0 0 1 8 0v4"></path>
                                            </svg></span>';
                                        }
                                        @endphp
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
