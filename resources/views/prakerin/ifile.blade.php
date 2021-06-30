@extends('layouts.app2')

@section('css')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" /> --}}
@endsection 

@section('content')
<section id="basic-datatable">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">File Magang - {{ $vacancy->title }}</h4>
                    @if($vacancy->started_internship == 'yes')
                    <div class="card-subtitle float-right">
                      <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('vacancy.ifile.create', [$vacancy->id]) }}" data-container=".my-modal"><i class="fa fa-plus"></i></a>
                    </div>
                    @endif
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
                                        <th>Kandidat</th>
                                        @if($vacancy->started_internship == 'yes')
                                        <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($file_industry as $key => $value)
                                    <tr>
                                        <td>{{ $value->title ?? '' }}</td>
                                        <td>{{ $value->description ?? '' }}</td>
                                        <td>
                                          <a href="{{ asset('uploads/files/'.$value->file) ?? '' }}" target="_blank">Lihat</a>
                                        </td>
                                        <td>{{ $value->student->name ?? '' }}</td>
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
@endsection