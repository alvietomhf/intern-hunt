@extends('layouts.app2')

@section('content')
<section id="basic-datatable">
  <div class="row">
      <div class="col-12">
        @include('flash::message')
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Siswa</h4>
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <div class="table-responsive">
                          <table class="table zero-configuration datatable">
                              <thead>
                                  <tr>
                                    <th>Nama</th>
                                    <th>Profil</th>
                                    <th>Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($data as $key => $value)
                                <tr>
                                  <td>{{ $value->name ?? '' }}</td>
                                  <td>
                                    <button data-href="{{ route('student.show', [$value->id]) }}" data-container=".my-modal" class="btn btn-info btn-sm btn-modal"><i class="fa fa-eye"></i> Lihat</button>
                                  </td>
                                  <td>
                                    <button data-href="{{ route('student.edit', [$value->id]) }}" data-container=".my-modal" class="btn btn-warning btn-sm btn-modal"><i class="fa fa-pencil"></i> Ubah Password</button>
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
</script>
@endsection