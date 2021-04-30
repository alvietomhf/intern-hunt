@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
@endsection

@section('content')
<div id="user-profile">
  @role('siswa|guru')
  <section id="profile-info">
    @include('flash::message')
      <div class="row d-flex justify-content-start">
          <div class="col-lg-4 col-12">
              <div class="card">
                  <div class="card-header">
                      <h4>Biografi</h4>
                      @if(!$biography)
                      <span class="btn-modal" data-href="{{ route('biography.create') }}" data-container=".my-modal"><i class="feather icon-plus cursor-pointer" title="Tambah"></i></span>
                      @else
                      <span class="btn-modal" data-href="{{ route('biography.edit', [$biography->id]) }}" data-container=".my-modal"><i class="feather icon-edit-2 cursor-pointer" title="Edit"></i></span>
                      @endif
                  </div>
                  <div class="card-body">
                      <p>{{ $biography->description ?? '' }}</p>
                      <div class="mt-1">
                          <h6 class="mb-0">Bergabung:</h6>
                          <p>{{ auth()->user()->created_at->format('d, F Y') }}</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pengalaman</h4>
                    <div class="card-subtitle float-right">
                        <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('experience.create') }}" data-container=".my-modal"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table nowrap scroll-horizontal-vertical datatable">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Rentang tahun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($experience as $key => $value)
                                    <tr>
                                        <td>{{ $value->title ?? '' }}</td>
                                        <td>{{ $value->description ?? '' }}</td>
                                        <td>{{ $value->begin_at ?? '' }} - {{ $value->end_at ?? '' }}</td>
                                        <td>
                                          <button data-href="{{ route('experience.edit', [$value->id]) }}" data-container=".my-modal" class="btn btn-warning btn-sm btn-modal"><i class="fa fa-pencil"></i></button>
                                          <button data-href="{{ route('experience.destroy', [$value->id]) }}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash-o"></i></button> 
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
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Portofolio</h4>
                    <div class="card-subtitle float-right">
                        <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('portfolio.create') }}" data-container=".my-modal"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table nowrap scroll-horizontal-vertical datatable">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>File</th>
                                        <th>Tag</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($portfolio as $key => $value)
                                    <tr>
                                      <td>{{ $value->title ?? '' }}</td>
                                      <td>{{ $value->description ?? '' }}</td>
                                      <td><a class="badge badge-info" href="{{ asset('uploads/files/'. $value->file) }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-eye"></i></a></td>
                                      <td>
                                        @foreach ($value->tags as $tag)
                                        <span class="badge badge-pill badge-light">{{ $tag->name }}</span>
                                        @endforeach
                                      </td>
                                      <td>
                                        <button data-href="{{ route('portfolio.edit', [$value->id]) }}" data-container=".my-modal" class="btn btn-warning btn-sm btn-modal"><i class="fa fa-pencil"></i></button>
                                        <button data-href="{{ route('portfolio.destroy', [$value->id]) }}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash-o"></i></button> 
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
  @endrole
  @role('industri')
  <section id="basic-carousel">
    @include('flash::message')
    <div class="row d-flex justify-content-around">
      <div class="col-md-4 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Biografi {{ $biography->name ?? '' }}</h4>
                @if(!$biography)
                <span class="btn-modal" data-href="{{ route('biography.create') }}" data-container=".my-modal"><i class="feather icon-plus cursor-pointer" title="Tambah"></i></span>
                @else
                <span class="btn-modal" data-href="{{ route('biography.edit', [$biography->id]) }}" data-container=".my-modal"><i class="feather icon-edit-2 cursor-pointer" title="Edit"></i></span>
                @endif
            </div>
            <div class="card-body">
                <p>{{ $biography->description ?? '' }}</p>
                <div class="mt-1">
                    <h6 class="mb-0">Bergabung:</h6>
                    <p>{{ auth()->user()->created_at->format('d, F Y') }}</p>
                </div>
            </div>
        </div>
      </div>
      @if (isset($biography->image))
      <div class="col-md-6 col-sm-12">
          <div class="card">
              <div class="card-content">
                  <div class="card-body">
                      <div id="bio-image" class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">
                            @if (isset($biography->image))
                                @foreach (json_decode($biography->image) as $key => $img)
                                <li data-target="#bio-image" data-slide-to="{{ $key }}"></li>
                                @endforeach
                            @endif
                          </ol>
                          <div class="carousel-inner" role="listbox">
                            @if (isset($biography->image))
                                @foreach (json_decode($biography->image) as $key => $img)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                  <img class="img-fluid" src="{{ asset('uploads/images/'.$img) }}">
                                </div>
                                @endforeach
                            @endif
                          </div>
                          <a class="carousel-control-prev" href="#bio-image" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#bio-image" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      @endif
    </div>
  </section>
  @endrole
</div>
<div class="modal fade my-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script>
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
                              btn.closest('td').parent('tr').fadeOut();
                              // window.location.href = res.url
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