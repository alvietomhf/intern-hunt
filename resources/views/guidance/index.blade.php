@extends('layouts.app2')

@section('content')
<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      @include('flash::message')
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Grup Bimbingan</h4>
                  <div class="card-subtitle float-right">
                      <a class="btn btn-primary btn-modal" href="{{ route('guidance.create') }}"><i class="fa fa-plus"></i> Buat Grup</a>
                  </div>
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <div class="table-responsive">
                          <table class="table zero-configuration datatable">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Nama</th>
                                      <th>Perusahaan</th>
                                      <th>Tanggal Diterima</th>
                                      <th>Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($data as $key => $value)
                                @php
                                    $gs = App\GuidanceStudent::where('guidance_id', $value->id)->first();
                                    $sId = $gs->student->id;
                                    $vapp = null;
                                    if(isset($gs->student->vapplicant)){
                                        foreach($gs->student->vapplicant as $applicant){
                                            if($applicant->status == 'approved' && $applicant->vacancy->started_internship == 'yes'){
                                                $vapp = App\VacancyApplicant::find($applicant->id);
                                            }
                                        }
                                    }
                                @endphp
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $value->name ?? '' }}</td>
                                  <td>@if($vapp && isset($vapp->biography_id)){{ $vapp->biography->name ? $vapp->biography->name : $vapp->biography->user->name }}@else @php if(isset($vapp->note)) (list($name, $address) = explode('|',$vapp->note)) @endphp {{ $name ?? '' }}@endif</td>
                                  <td>@if(isset($vapp)){{ \Carbon\Carbon::parse($vapp->acc)->format('d-m-Y') }}@endif</td>
                                  <td>
                                      <a href="{{ route('guidance.show', [$value->slug]) }}" class="btn btn-info btn-sm btn-modal"><i class="fa fa-eye"></i> Daftar Siswa</a>
                                      <button data-href="{{ route('guidance.edit', [$value->slug]) }}" data-container=".my-modal" class="btn btn-warning btn-sm btn-modal"><i class="fa fa-pencil"></i> Ubah Nama</button>
                                      <button data-href="{{ route('guidance.destroy', [$value->slug]) }}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash-o"></i> Hapus</button> 
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