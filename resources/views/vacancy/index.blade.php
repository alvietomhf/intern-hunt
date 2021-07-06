@extends('layouts.app2')

@section('css')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection 

@if($type == 'all')
@section('content-header')
<div class="content-header-left col-md-9 col-12 mb-2">
  <div class="row breadcrumbs-top">
      <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Lowongan</h2>
      </div>
  </div>
</div>
@endsection
@endif

@section('content')
<section id="basic-datatable">
  @include('flash::message')
  @if($type == 'all')
  <section id="wishlist" class="grid-view wishlist-items">
    @foreach ($data as $key => $value)
    <div class="card ecommerce-card">
        <div class="card-content">
            <div class="item-img">
                <div class="card overlay-img-card text-dark">
                    <img src="{{ asset('uploads/images/'.$value->biography->user->image) }}" class="card-img" alt="card-img-6" width="300px" height="200px">
                </div>
            </div>
            <div class="card-body">
                <div class="item-wrapper">
                    <h6 class="text-dark">{{ $value->title ?? '' }}</h6>
                </div>
                <div>
                    <p style="font-size:0.7rem">{{ $value->biography->name ?? '' }}</p>
                    <p class="item-description">
                        {{ \Carbon\Carbon::parse($value->begin_at)->format('d/m/Y') ?? '' }} - {{ \Carbon\Carbon::parse($value->end_at)->format('d/m/Y') ?? '' }}
                    </p>
                </div>
            </div>
            <div class="item-options text-center btn-modal pt-1" data-href="{{ route('vacancy.show', [$value->id]) }}" data-container=".my-modal" >
                <div class="cart">
                    <i class="feather icon-navigation-2"></i> <span >Detail</span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
  @else
    <div class="row">
    @if($detail == 'lowongan')
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card">
          <div class="card-header">
              <h4 class="card-title">Lowongan</h4>
              <div class="card-subtitle float-right">
                  <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('vacancy.create') }}" data-container=".my-modal"><i class="fa fa-plus"></i> Tambah</a>
              </div>
          </div>
          <div class="card-content">
              <div class="card-body card-dashboard">
                  <div class="table-responsive">
                      <table class="table zero-configuration datatable">
                          <thead>
                              <tr>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($data as $key => $value)
                            <tr>
                                <td>{{ $value->title ?? '' }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->begin_at)->format('d/m/Y') ?? '' }} - {{ \Carbon\Carbon::parse($value->end_at)->format('d/m/Y') ?? '' }}</td>
                                <td>
                                  <button data-href="{{ route('vacancy.status', [$value->id]) }}" data-status="{{ $value->active == 'yes' ? 'menonaktifkan' : 'mengaktifkan' }}" class="btn btn-secondary btn-sm btn-status"><i class="fa fa-{{ $value->active == 'yes' ? 'unlock' : 'lock' }}"></i> {{ $value->active == 'yes' ? ' Nonaktifkan' : ' Aktifkan' }}</button>
                                  <button data-href="{{ route('vacancy.show', [$value->id]) }}" data-container=".my-modal" class="btn btn-info btn-sm btn-modal"><i class="fa fa-eye"></i> Lihat</button>
                                  <button data-href="{{ route('vacancy.edit', [$value->id]) }}" data-container=".my-modal" class="btn btn-warning btn-sm btn-modal"><i class="fa fa-pencil"></i> Edit</button>
                                  <button data-href="{{ route('vacancy.destroy', [$value->id]) }}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash-o"></i> Hapus</button> 
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
    @else
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card">
          <div class="card-header">
              <h4 class="card-title">Proposal</h4>
          </div>
          <div class="card-content">
              <div class="card-body card-dashboard">
                  <div class="table-responsive">
                      <table class="table zero-configuration datatable">
                          <thead>
                              <tr>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Pelamar</th>
                                <th>Status</th>
                                <th>Detail</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($data as $key => $value)
                            <tr>
                              <td>{{ $value->vacancy->title ?? '' }}</td>
                              <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                              <td>{{ $value->user->name ?? '' }}</td>
                              <td>
                                  @if($value->status == 'waiting')
                                  <span class="btn-action badge badge-pill badge-success" style="cursor: pointer;" data-status="menerima" data-href="{{ route('vacancy.action', [$value->id, 'approved']) }}"><i class="feather icon-check" title="Terima"> Terima</i></span>
                                  <span class="btn-action badge badge-pill badge-danger" style="cursor: pointer;" data-status="menolak" data-href="{{ route('vacancy.action', [$value->id, 'rejected']) }}"><i class="feather icon-x" title="Tolak"> Tolak</i></span>
                                  @else
                                  <span class="badge badge-pill badge-{{ $value->status != 'approved' ? 'danger' : 'primary'}}" style="cursor: pointer;"><i class="feather icon-circle-o">{{ $value->status }}</i></span>
                                  @endif
                              </td>
                              <td>
                                <button data-href="{{ route('prakerin.show_s', [$value->user->id]) }}" data-container=".my-modal" class="btn btn-warning btn-sm btn-modal"><i class="fa fa-eye"></i> Profil</button>
                                <a target="_blank" href="{{ asset('uploads/files/'.$value->file ) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Proposal</a>
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
    @endif
    </div>
  @endif
</section>
<div class="modal my-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
<div class="modal child-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
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

  $('.datatable').on('click', '.btn-action', function(e){
      var btn = $(this);
      var status = btn.data('status');
      e.stopPropagation();
      Swal.fire({
          title: 'Anda yakin?',
          text: `Anda akan ${status} lamaran ini!`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya Lakukan!'
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

  $('.datatable').on('click', '.btn-status', function(e){
      var btn = $(this);
      var status = btn.data('status');
      e.stopPropagation();
      Swal.fire({
          title: 'Anda yakin?',
          text: `Anda akan ${status} lowongan ini!`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya Lakukan!'
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
                              icon: res.icon,
                              title: res.title,
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