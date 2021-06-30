@extends('layouts.app2')

@section('css')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection 

@section('content-header')
<div class="col-12 mb-2">
    @if(isset($industry) && isset($industry->biography))
    <button class="btn btn-danger btn-end" data-href="{{ route('prakerin.end_student', [$industry->vacancy_id, $industry->id]) }}"><i class="fa fa-exclamation-circle"> Akhiri Magang</i></button>
    @else
    <button class="btn btn-danger btn-end" data-href="{{ route('prakerin.end_student2', [$industry->vacancy_id, $industry->id]) }}"><i class="fa fa-exclamation-circle"> Akhiri Magang</i></button>
    @endif
</div>
@endsection

@section('content')
<section id="basic-datatable">
  @include('flash::message')
    <div class="row d-flex justify-content-between">
        <div class="col-lg-6 col-12">
          <div class="card">
            <div class="card-header">
                <h4>Profil Guru Pembimbing</h4>
                <i class="feather icon-more-horizontal cursor-pointer"></i>
            </div>
            <div class="card-body">
                <a class="my-25" href="javascript: void(0);">
                    <img src="{{ asset('uploads/images/'.$teacher->image) }}" alt="users avatar" class="users-avatar-shadow rounded" height="90" width="90">
                </a>
                <p class="mt-1">{{ $teacher->biography->description ?? '' }}</p>
                <div class="mt-1">
                    <h6 class="mb-0">Nama:</h6>
                    <p>{{ $teacher->name ?? '' }}</p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-0">Alamat:</h6>
                    <p>{{ $teacher->address ?? '' }}</p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-0">Nomor HP:</h6>
                    <p>{{ $teacher->phone ?? '' }}</p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-0">Sekolah:</h6>
                    <p>{{ $teacher->schname ?? '' }}</p>
                </div>
            </div>
          </div>
        </div>
        @if(isset($industry) && isset($industry->biography))
        <div class="col-lg-6 col-12">
          <div class="card">
            <div class="card-header">
                <h4>Profil Industri</h4>
                <i class="feather icon-more-horizontal cursor-pointer"></i>
            </div>
            <div class="card-body">
                <a class="my-25" href="javascript: void(0);">
                    <img src="{{ asset('uploads/images/'.$industry->biography->user->image) }}" alt="users avatar" class="users-avatar-shadow rounded" height="90" width="90">
                </a>
                <p class="mt-1">{{ $industry->biography->description ?? '' }}</p>
                <div class="mt-1">
                    <h6 class="mb-0">Nama:</h6>
                    <p>{{ $industry->biography->name ?? '' }}</p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-0">Alamat:</h6>
                    <p>{{ $industry->biography->address ?? '-' }}</p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-0">Email:</h6>
                    <p>{{ $industry->biography->email ?? '-' }}</p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-0">Nomor HP:</h6>
                    <p>{{ $industry->biography->phone ?? '-' }}</p>
                </div>
            </div>
          </div>
        </div>
        @else
        @php
        list($name, $address) = explode('|', $industry->note);
        @endphp
        <div class="col-lg-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>Profil Industri</h4>
                  <i class="feather icon-more-horizontal cursor-pointer"></i>
              </div>
              <div class="card-body">
                  <div class="mt-1">
                      <h6 class="mb-0">Nama:</h6>
                      <p>{{ $name ?? '' }}</p>
                  </div>
                  <div class="mt-1">
                      <h6 class="mb-0">Alamat:</h6>
                      <p>{{ $address ?? '' }}</p>
                  </div>
              </div>
            </div>
          </div>
        @endif
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
                    @if(isset($industry) && isset($industry->biography_id))
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
                                    <h4 class="card-title">Jurnal</h4>
                                    <p>Isi jurnal selama prakerin berjalan untuk dijadikan laporan prakerin</p>
                                </div>
                                <div class="card-subtitle float-right">
                                  <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('journal.create') }}" data-container=".my-modal"><i class="fa fa-plus"></i></a>
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
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($journal as $key => $value)
                                                <tr>
                                                    <td>{{ $value->title ?? '' }}</td>
                                                    <td>{{ $value->description ?? '' }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($value->date)) ?? '' }}</td>
                                                    <td>
                                                      <button data-href="{{ route('journal.edit', [$value->id]) }}" data-container=".my-modal" class="btn btn-warning btn-sm btn-modal"><i class="fa fa-pencil"></i> Edit</button>
                                                      <button data-href="{{ route('journal.destroy', [$value->id]) }}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash-o"></i> Hapus</button> 
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
                    <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-subtitle float-left">
                                    <h4 class="card-title">File Siswa</h4>
                                    <p>Kirimkan file yang diperlukan ke industri lewat menu ini</p>
                                </div>
                                <div class="card-subtitle float-right">
                                  <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('sfile.create') }}" data-container=".my-modal"><i class="fa fa-plus"></i></a>
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
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sfile as $key => $value)
                                                <tr>
                                                    <td>{{ $value->title ?? '' }}</td>
                                                    <td>{{ $value->description ?? '' }}</td>
                                                    <td>
                                                      <a href="{{ asset('uploads/files/'.$value->file) ?? '' }}" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                                                    </td>
                                                    <td>
                                                      <button data-href="{{ route('sfile.edit', [$value->id]) }}" data-container=".my-modal" class="btn btn-warning btn-sm btn-modal"><i class="fa fa-pencil"></i> Edit</button>
                                                      <button data-href="{{ route('sfile.destroy', [$value->id]) }}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash-o"></i> Hapus</button> 
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
                    <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-subtitle float-left">
                                    <h4 class="card-title">File Industri</h4>
                                    <p>Semua file yang dikirimkan oleh industri akan ditampilkan disini</p>
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
                                                    <th>Lihat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ifile as $key => $value)
                                                <tr>
                                                    <td>{{ $value->title ?? '' }}</td>
                                                    <td>{{ $value->description ?? '' }}</td>
                                                    <td>
                                                      <a href="{{ asset('uploads/files/'.$value->file) ?? '' }}" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</a>
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
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade my-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
@endsection

@section('js')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script>
  $('.datatable').on('click', '.btn-modal', function(e){
      var t = $(this).data("container")
      $.ajax({
          url: $(this).data('href'),
          dataType: "html",
          success: function(e) {
              $(t).html(e).modal("show")
          }
      })
  })

  $('.datatable').on('click', '.btn-delete', function(e){
      var btn = $(this);
      e.stopPropagation();
      Swal.fire({
          title: 'Anda yakin?',
          text: "Anda akan menghapus data ini!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus!'
      }).then((result) => {
          if (result.value) {
              $.ajax({
                  url: btn.data('href'),
                  method: 'DELETE',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  dataType: 'json',
                  success: function(res) {
                      if(res.status) {
                          Swal.fire({
                              icon: 'success',
                              title: 'Berhasil',
                              text: res.message
                          }).then((result) => {
                              window.location.href = res.url
                          })
                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Gagal',
                              text: res.message
                          })
                      }
                  }
              })
          }
      })
  });

  $('.btn-end').on('click', function(e){
      var btn = $(this);
      e.stopPropagation();
      Swal.fire({
          title: 'Anda yakin?',
          text: "Anda akan mengakhiri magang!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Akhiri!'
      }).then((result) => {
          if (result.value) {
              $.ajax({
                  url: btn.data('href'),
                  method: 'POST',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  dataType: 'json',
                  success: function(res) {
                      if(res.status) {
                          Swal.fire({
                              icon: 'success',
                              title: 'Berhasil',
                              text: res.message
                          }).then((result) => {
                              window.location.href = res.url
                          })
                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Gagal',
                              text: res.message
                          })
                      }
                  }
              })
          }
      })
  });
</script>
@endsection