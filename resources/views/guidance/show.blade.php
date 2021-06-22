@extends('layouts.app2')

@section('content-header')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
                <a href="{{ route('guidance.index') }}" class="btn btn-secondary"><i class="feather icon-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>
<div class="content-header-right text-md-right col-md-3 col-12 d-md-block">
    <div class="form-group breadcrum-right">
        <div class="dropdown">
            <a class="btn btn-primary btn-modal" href="{{ route('guidance_s.create', [$guidance->slug]) }}"><i class="fa fa-plus"></i> Tambah Siswa</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<section id="basic-datatable">
  <div class="row">
        <div class="col-12">
          @include('flash::message')
          <div class="card">
              <div class="card-header justify-content-center mb-2">
                {{-- <a href="{{ route('guidance.index') }}" class="btn btn-secondary"><i class="feather icon-arrow-left"></i> Kembali</a> --}}
                <h4 class="card-title">{{ $guidance->name ?? '' }}</h4>
                {{-- <a class="btn btn-primary btn-modal" href="{{ route('guidance_s.create', [$guidance->slug]) }}"><i class="fa fa-plus"></i> Tambah Siswa</a> --}}
              </div>
              {{-- <div class="card-content">
                  <div class="card-body card-dashboard">
                      
                      <div class="table-responsive">
                          <table class="table zero-configuration datatable">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Nama</th>
                                      <th>Profil</th>
                                      <th>Jurnal</th>
                                      <th>File</th>
                                      <th>Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($students as $key => $value)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $value->student->name ?? '' }}</td>
                                  <td>
                                    <button data-href="{{ route('guidance_s.sprofile', [$guidance->slug, $value->id]) }}" data-container=".my-modal" class="btn btn-info btn-sm btn-modal"><i class="fa fa-eye"></i> Siswa</button>
                                    @php
                                    $vapp = null;
                                    if(isset($value->student->vapplicant)){
                                        foreach($value->student->vapplicant as $applicant){
                                            if($applicant->status == 'approved' && $applicant->vacancy->started_internship == 'yes'){
                                                $vapp = App\VacancyApplicant::find($applicant->id);
                                            }
                                        }
                                    }
                                    @endphp
                                    @if($vapp)
                                    <button data-href="{{ route('guidance_s.iprofile', [$guidance->slug, $value->id]) }}" data-container=".my-modal" class="btn btn-info btn-sm btn-modal"><i class="fa fa-eye"></i> Industri</button>
                                    @endif
                                  </td>
                                  <td>
                                    @if($vapp)
                                    <a href="{{ route('guidance_s.journal', [$guidance->slug, $value->student_id, $vapp->vacancy_id]) }}" class="btn btn-success btn-sm btn-modal"><i class="fa fa-eye"></i> Jurnal</a>
                                    @endif
                                  </td>
                                  <td>
                                    @if($vapp)
                                    <a href="{{ route('guidance_s.sfile', [$guidance->slug, $value->student_id, $vapp->vacancy_id]) }}" class="btn btn-info btn-sm btn-modal"><i class="fa fa-eye"></i> Siswa</a>
                                    @if($vapp && isset($vapp->biography_id))
                                    <a href="{{ route('guidance_s.ifile', [$guidance->slug, $value->student_id, $vapp->vacancy_id]) }}" class="btn btn-info btn-sm btn-modal"><i class="fa fa-eye"></i> Industri</a>
                                    @endif
                                    @endif
                                  </td>
                                  <td>
                                      <button data-href="{{ route('guidance_s.destroy', [$guidance->slug, $value->id]) }}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash-o"></i></button> 
                                  </td>
                                </tr>  
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div> --}}
          </div>
        </div>
  </div>
</section>
<section id="basic-examples">
    <div class="row match-height">
        @foreach ($students as $key => $value)
        @php
        $vapp = null;
        if(isset($value->student->vapplicant)){
            foreach($value->student->vapplicant as $applicant){
                if($applicant->status == 'approved' && $applicant->vacancy->started_internship == 'yes'){
                    $vapp = App\VacancyApplicant::find($applicant->id);
                }
            }
        }
        @endphp
        <div class="col-xl-4 col-md-6 col-sm-12 profile-card-3">
            <div class="card">
                <div class="card-header mx-auto">
                    <div class="avatar avatar-xl">
                        <a href="{{ route('guidance_s.sprofile', [$guidance->slug, $value->id]) }}"><img class="img-fluid" src="{{ asset('uploads/images/'.$value->student->image) }}" alt="img placeholder"></a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body text-center">
                        <a href="{{ route('guidance_s.sprofile', [$guidance->slug, $value->id]) }}"><h4>{{ $value->student->name ?? '' }}</h4></a>
                        <p class="">{{ $value->student->schname ?? '' }} - {{ $value->student->department ?? '' }}</p>
                        <div class="card-btns d-flex justify-content-between">
                            @if(isset($vapp))
                            <a href="{{ route('guidance_s.journal', [$guidance->slug, $value->student_id, $vapp->vacancy_id]) }}" class="btn btn-outline-info btn-sm">Detail</a>
                            @endif
                            <button data-href="{{ route('guidance_s.destroy', [$guidance->slug, $value->id]) }}" class="btn btn-outline-danger btn-sm btn-delete">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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

  $('.btn-delete').on('click', function(e){
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