@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
@endsection

@section('content')
<div id="user-profile">
  @role('siswa|guru')
  <section id="profile-info">
    @include('flash::message')
    @include('profiles.partials.bio')
    <div class="row">
        <div class="col-12">
            <div class="card">  
              <div class="card-header">
                  <div class="float-left">
                    <h1>Pengalaman</h1>
                  </div>
                  <div class="float-right">
                    <a class="btn btn-modal" href="javascript:void(0);" data-href="{{ route('experience.create') }}" data-container=".my-modal"><i class="fa fa-plus fa-2x"></i></a>
                  </div>
              </div>
              <hr class="bg-primary">
              <div class="card-body">
                @foreach ($experience as $key => $value)
                        <div class="d-flex justify-content-between">
                            <h4 class="ml-2">{{ $value->title ?? '' }}</h4>
                            <div>
                              <button data-href="{{ route('experience.edit', [$value->id]) }}" data-container=".my-modal" class="btn btn-modal"><i class="fa fa-pencil"></i></button>
                              <button data-href="{{ route('experience.destroy', [$value->id]) }}" class="btn btn-delete"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </div>
                        <p class="ml-2">{{ $value->description ?? '' }}</p>
                        <p class="text-small text-muted ml-2">{{ $value->begin_at ?? '' }} @if($value->end_at != 'now') - {{ $value->end_at ?? '' }} @else sampai saat ini @endif</p>
                @if(auth()->user()->experience) <hr> @endif
                @endforeach
              </div>  
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">  
              <div class="card-header">
                  <div class="float-left">
                    <h1>Portofolio</h1>
                  </div>
                  <div class="float-right">
                    <a class="btn btn-modal" href="javascript:void(0);" data-href="{{ route('portfolio.create') }}" data-container=".my-modal"><i class="fa fa-plus fa-2x"></i></a>
                  </div>
              </div>
              <hr class="bg-primary">
              <div class="card-body">
                @foreach ($portfolio as $key => $value)
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="ml-2">{{ $value->title ?? '' }}</h4>
                                <span class="ml-2 badge badge-pill badge-light">{{ App\Tag::find($value->tag_id)->name ?? '' }}</span>
                            </div>
                            <div class="mt-3 d-flex">
                              <button data-href="{{ route('portfolio.edit', [$value->id]) }}" data-container=".my-modal" class="d-inline btn btn-modal"><i class="fa fa-pencil"></i></button>
                              <button data-href="{{ route('portfolio.destroy', [$value->id]) }}" class="d-inline btn btn-delete"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </div>
                        <p class="ml-2">{{ $value->description ?? '' }}</p>
                        <a class="ml-2" href="{{ asset('uploads/files/'. $value->file) }}" target="_blank" rel="noopener noreferrer">{{ $value->file ?? '' }}</a>
                @if(auth()->user()->portfolio) <hr> @endif
                @endforeach
              </div>  
            </div>
        </div>
    </div>
  </section>
  @endrole
  @role('industri')
  <section id="basic-carousel">
    @if(!(isset($biography->email) && isset($biography->address) && isset($biography->phone) && isset($biography->image)))
    <div class="alert alert-warning" role="alert">
      Profil atau foto anda belum lengkap! Tekan tombol untuk melengkapi <a type="button" class="btn btn-sm btn-modal btn-primary text-white" data-href="{{ route('biography.edit', [$biography->id]) }}" data-container=".my-modal">Lengkapi</a>
    </div>
    @endif
    @include('flash::message')
    @include('profiles.partials.bio')
    <div class="row">
        <div class="col-12">
            <div class="card">  
              <div class="card-header">
                  <div class="float-left">
                    <h1>Galeri</h1>
                  </div>
                  <div class="float-right">
                    <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('bio.imageCreate') }}" data-container=".my-modal">Tambah Foto</a>
                  </div>
              </div>
              <hr class="bg-primary">
              <div class="card-body">
                @if (isset($biography->image))
                <div class="row">
                  @foreach (json_decode($biography->image) as $key => $img)
                  <div class="col-lg-3 col-md-6 col-sm-12">
                      <div class="card">
                          <div class="card-content">
                              <img class="card-img img-fluid" src="{{ asset('uploads/images/'.$img->name) }}" alt="Card image">
                              <div class="card-img-overlay overflow-hidden">
                                <div class="row d-flex justify-content-end">
                                  <button data-href="{{ route('bio.imageDelete', [$img->id]) }}" class="btn btn-sm btn-danger mr-2 btn-delete"><i class="fa fa-trash-o"></i></button>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  @endforeach
                </div>
                @endif
              </div>  
            </div>
        </div>
    </div>
  </section>
  @endrole
</div>
<div class="modal fade my-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script>
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