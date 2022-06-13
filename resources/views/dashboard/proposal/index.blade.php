@extends('dashboard.layouts.main')

@section('container')
<div class="page-body">
    <div class="container-xl">
        <div class="page-header mb-4">
            <div class="row align-items-center mw-100">
                <div class="col">
                    <div class="mb-1">
                        <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Manajemen Proposal</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">
                        <span class="mx-auto">Tabel Proposal</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-table table-responsive p-3">
                    <table class="table" id="myProposal">
                        <thead>
                            <tr>
                                <th scope="col">Nama UKM</th>
                                <th scope="col">Judul Proposal</th>
                                <th scope="col">Nama Kegiatan</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Tanggal Prposal</th>
                                <th scope="col">Tanggal diupload</th>
                                <th scope="col">Tanggal diubah</th>
                                <th scope="col">File</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                            <caption>
                                Petunjuk
                                <span class="form-help" data-bs-toggle="popover" data-bs-placement="right" data-bs-html="true" data-bs-content="<p>ZIP Code must be US or CDN format. You can use an extended ZIP+4 code to determine address more accurately.</p>
                                    <p class='mb-0'><a href=''>USP ZIP codes lookup tools</a></p>
                                    ">?</span>
                                </caption>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
