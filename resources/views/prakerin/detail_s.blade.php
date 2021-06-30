@extends('layouts.app2')

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
<section id="basic-datatable">
  @include('flash::message')
    <div class="row d-flex justify-content-between">
        <div class="col-lg-6 col-12">
          <div class="card">
            <div class="card-header">
                <h4>Profil Siswa</h4>
                <i class="feather icon-more-horizontal cursor-pointer"></i>
            </div>
            <div class="card-body">
                <a class="my-25" href="javascript: void(0);">
                    <img src="{{ asset('uploads/images/'.$student->image) }}" alt="users avatar" class="users-avatar-shadow rounded" height="90" width="90">
                </a>
                <p class="mt-1">{{ $student->biography->description ?? '' }}</p>
                <div class="mt-1">
                    <h6 class="mb-0">Nama:</h6>
                    <p>{{ $student->name ?? '' }}</p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-0">Alamat:</h6>
                    <p>{{ $student->address ?? '' }}</p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-0">Nomor HP:</h6>
                    <p>{{ $student->phone ?? '' }}</p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-0">Sekolah:</h6>
                    <p>{{ $student->schname ?? '' }} / {{ $student->department ?? '' }}</p>
                </div>
            </div>
          </div>
        </div>
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
    </div>
</section>
<section id="basic-datatable">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Jurnal</h4>
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <p class="card-text">Berisi jurnal yang dikirimkan oleh siswa</p>
                      <div class="table-responsive">
                          <table class="table zero-configuration">
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

      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">File Siswa</h4>
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <p class="card-text">Berisi file yang dikirimkan oleh siswa</p>
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>File</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($student_file as $key => $value)
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

      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">File Industri</h4>
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <p class="card-text">Berisi file yang dikirimkan oleh industri ke siswa</p>
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>File</th>
                                    <th>Tanggal</th>
                                    @if($vacancy->started_internship == 'yes')
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($industry_file as $key => $value)
                                <tr>
                                    <td>{{ $value->title ?? '' }}</td>
                                    <td>{{ $value->description ?? '' }}</td>
                                    <td>
                                      <a href="{{ asset('uploads/files/'.$value->file) ?? '' }}" target="_blank">Lihat</a>
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($value->created_at)) ?? '' }}</td>
                                    @if($vacancy->started_internship == 'yes')
                                    <td>
                                      <button data-href="{{ route('vacancy.ifile.destroy', [$vacancy->id, $value->id]) }}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash-o"></i> Hapus</button> 
                                    </td>
                                    @endif
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
@endsection