@extends('dashboard.layouts.main')
@section('container')
<div class="page-body">
    <div class="container-xl">
        <div class="page-header">
            <div class="row align-items-center mw-100">
                <div class="col">
                    <div class="mb-1">
                        <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Logbook Kegiatan</a></li>
                        </ol>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-history" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <polyline points="12 8 12 12 14 14"></polyline>
                                <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5"></path>
                            </svg>
                            Riwayat
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cards mt-3">
            <div class="col-md-6 col-lg-3">
                <a href="#" class="card card-link card-link-pop">
                    <div class="card card-active">
                        <div class="ribbon ribbon-top bg-primary">
                            <h4>{{ $all }}</h4>
                        </div>
                        <div class="card-body">
                            <p>Seluruh Data</p>
                        </div>
                    </div>
                    {{-- <div class="card-body">Seluruh Data</div> --}}
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#" class="card card-link card-link-pop">
                    <div class="ribbon ribbon-top bg-secondary">
                        <h4>{{ $rpi }}</h4>
                    </div>
                    <div class="card-body">Robotika Polindra</div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#" class="card card-link card-link-pop">
                    <div class="ribbon ribbon-top bg-secondary">
                        <h4>{{ $sebura }}</h4>
                    </div>
                    <div class="card-body">Seni Budaya Polindra</div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#" class="card card-link card-link-pop">
                    <div class="ribbon ribbon-top bg-secondary">
                        <h4>{{ $kompa }}</h4>
                    </div>
                    <div class="card-body">Komunitas Mahasiswa Pecinta Alam</div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#" class="card card-link card-link-pop">
                    <div class="ribbon ribbon-top bg-secondary">
                        <h4>{{ $folafo }}</h4>
                    </div>
                    <div class="card-body">Foreign Language Forum</div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#" class="card card-link card-link-pop">
                    <div class="ribbon ribbon-top bg-secondary">
                        <h4>{{ $popi }}</h4>
                    </div>
                    <div class="card-body">Persatuan Olahraga Polindra</div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#" class="card card-link card-link-pop">
                    <div class="ribbon ribbon-top bg-secondary">
                        <h4>{{ $menwa }}</h4>
                    </div>
                    <div class="card-body">Resimen Mahasiswa</div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#" class="card card-link card-link-pop">
                    <div class="ribbon ribbon-top bg-secondary">
                        <h4>{{ $formadiksi }}</h4>
                    </div>
                    <div class="card-body">Forum Mahasiswa Bidik Misi</div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#" class="card card-link card-link-pop">
                    <div class="ribbon ribbon-top bg-secondary">
                        <h4>{{ $kopen }}</h4>
                    </div>
                    <div class="card-body">Kotak Pena</div>
                </a>
            </div>
        </div>
        <div class="col-12">
            <h2 class="page-title my-4">
                <span class="mx-auto">Tabel Logbook</span>
            </h2>
            @if(Session::has('delete_success'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Logbook dihapus'
                })
            </script>
            @endif
            <div class="card">
                <div class="card-table table-responsive p-3">
                    <table class="table" id="myLogbook">
                        <thead>
                            <tr>
                                <th>Nama UKM</th>
                                <th>Nama Kegiatan</th>
                                <th>Deskripsi Kegiatan</th>
                                <th>Tanggal Logbook</th>
                                <th>Hasil</th>
                                <th>Kendala</th>
                                <th>Tanggal dibuat</th>
                                <th>Tanggal diubah</th>
                                <th>Status Kegiatan</th>
                                <th></th>
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
