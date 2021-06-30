@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
@endsection

@section('content-header')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="feather icon-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div id="user-profile">
  <section id="profile-info">
    <div class="row">
        <div class="col-12">
            <div class="profile-header mb-2">
                <div class="relative">
                    <div class="cover-container">
                        <img class="img-fluid bg-cover rounded-0 w-100" style="height: 20rem" src="{{ $user->banner ? asset('uploads/images/'.$user->banner) : asset('assets/images/smkn1banner.jpg') }}" alt="User Profile Image">
                    </div>
                    <div class="profile-img-container d-flex align-items-center justify-content-between">
                        <img src="{{ asset('uploads/images/'.$user->image) }}" class="rounded-circle img-border box-shadow-1" alt="Card image">
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center profile-header-nav">
                        <div class="mt-5 ml-2">
                            <h1>{{ $user->name }}</h1>
                            <h6>Siswa di {{ $user->schname }}</h6>
                            <p>{{ $user->biography->description ?? '' }}</p>
                            <h6 class="mb-0">Bergabung:</h6>
                            <p>{{ $user->created_at->format('d, F Y') }}</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  
  <section class="users-edit">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                <span class="d-none d-sm-block">Jurnal</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                <span class="d-none d-sm-block">File Siswa</span>
                            </a>
                        </li>
                        @if(isset($vacanc))
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="social-tab" data-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="false">
                                <span class="d-none d-sm-block">File Industri</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-subtitle float-left">
                                        <h4 class="card-title">Jurnal {{ $user->name }}</h4>
                                        <p>Jurnal yang dikirim siswa ke industri</p>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Judul</th>
                                                        <th>Deskripsi</th>
                                                        <th>Tanggal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($journal as $key => $value)
                                                    <tr>
                                                        <td>{{ $value->title ?? '' }}</td>
                                                        <td>{{ $value->description ?? '' }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($value->date)) ?? '' }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-subtitle float-left">
                                        <h4 class="card-title">File {{ $user->name }}</h4>
                                        <p>File yang dikirim siswa ke industri</p>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Judul</th>
                                                        <th>Deskripsi</th>
                                                        <th>File</th>
                                                        <th>Tanggal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($sfile as $key => $value)
                                                    <tr>
                                                        <td>{{ $value->title ?? '' }}</td>
                                                        <td>{{ $value->description ?? '' }}</td>
                                                        <td>
                                                        <a href="{{ asset('uploads/files/'.$value->file) ?? '' }}" target="_blank">Lihat</a>
                                                        </td>
                                                        <td>{{ date('d/m/Y', strtotime($value->created_at)) ?? '' }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(isset($vacanc))
                        <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-subtitle float-left">
                                        <h4 class="card-title">File {{ $industry->biography->name }}</h4>
                                        <p>File yang dikirim industri ke siswa</p>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Judul</th>
                                                        <th>Deskripsi</th>
                                                        <th>File</th>
                                                        <th>Tanggal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ifile as $key => $value)
                                                    <tr>
                                                        <td>{{ $value->title ?? '' }}</td>
                                                        <td>{{ $value->description ?? '' }}</td>
                                                        <td>
                                                        <a href="{{ asset('uploads/files/'.$value->file) ?? '' }}" target="_blank">Lihat</a>
                                                        </td>
                                                        <td>{{ date('d/m/Y', strtotime($value->created_at)) ?? '' }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection