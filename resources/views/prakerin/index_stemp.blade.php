@extends('layouts.app2')

@section('css')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection 

@section('content')
<section id="basic-datatable">
    @if($not_acc == 'yes' && isset($applicant))
    <div class="alert alert-warning" role="alert">
        Anda telah diundang oleh teman satu grup bimbingan prakerin anda! Klik tombol dibawah ini untuk konfirmasi!
        <div class="mt-1">
            <a type="button" class="btn btn-sm btn-action btn-modal btn-primary text-dark" data-status="menerima" data-href="{{ route('vacancy.action_custom', [$applicant->id, 'approved']) }}">Terima</a>
            <a type="button" class="btn btn-sm btn-action btn-modal btn-danger text-white" data-status="menolak" data-href="{{ route('vacancy.action_custom', [$applicant->id, 'rejected']) }}">Tolak</a>
        </div>
    </div>
    @endif
  @include('flash::message')
    <div class="row d-flex justify-content-between">
        <div class="col-12">
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
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Perusahaan</h4>
                  <div class="card-subtitle float-right">
                      <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('internship.create') }}" data-container=".my-modal"><i class="fa fa-plus"></i></a>
                  </div>
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <div class="table-responsive">
                          <table class="table zero-configuration datatable">
                              <thead>
                                  <tr>
                                      <th>Nama</th>
                                      <th>Alamat</th>
                                      <th>Status</th>
                                      <th>Mulai</th>
                                      <th>Berakhir</th>
                                      <th>Detail</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($experience as $key => $value)
                                  <tr>
                                      <td>{{ $value->name ?? '' }}</td>
                                      <td>{{ $value->address ?? '' }}</td>
                                      <td>
                                        <div class="badge badge-pill badge-primary">{{ $value->status ?? '' }}</div>
                                      </td>
                                      <td>{{ \Carbon\Carbon::parse($value->start)->format('d-m-Y') ?? '' }}</td>
                                      <td>{{ \Carbon\Carbon::parse($value->end)->format('d-m-Y') ?? '' }}</td>
                                      <td><a href="{{ route('prakerin.history', [$value->id, $value->vacancy_id]) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</a></td>
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
</script>
<script>
$('.btn-action').on('click', function(e){
      var btn = $(this);
      var status = btn.data('status');
      e.stopPropagation();
      Swal.fire({
          title: 'Anda yakin?',
          text: `Anda akan ${status} undangan ini!`,
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
</script>
@endsection