@extends('layouts.app2')

@section('css')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection 
@if($detail == 'lowongan')
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
@include('flash::message')
@if($detail == 'lowongan')
    <section id="wishlist" class="grid-view wishlist-items">
        @php
        $data_top = $data->take(3)->values();
        $data_bottom = $data->skip(3)->values();
        @endphp
        @foreach ($data_top as $key => $value)
        <div class="card ecommerce-card">
            <div class="card-content">
                <div class="item-img">
                    <div class="card overlay-img-card text-dark">
                        <img src="{{ asset('uploads/images/'.$value->image) }}" class="card-img" alt="card-img-6" width="300px" height="200px">
                        <div class="card-img-overlay">
                            <div class="badge badge-pill badge-glow badge-primary">Rekomendasi</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="item-wrapper">
                        {{-- <h6 class="text-dark">{{ $value->title ?? '' }} | {{ $value->ranking }}</h6> --}}
                        <h6 class="text-dark">{{ $value->title ?? '' }}</h6>
                    </div>
                    <div>
                        <p style="font-size:0.7rem">{{ $value->name ?? '' }}</p>
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
        @foreach ($data_bottom as $key => $value)
        <div class="card ecommerce-card">
            <div class="card-content">
                <div class="item-img">
                    <div class="card overlay-img-card text-dark">
                        <img src="{{ asset('uploads/images/'.$value->image) }}" class="card-img" alt="card-img-6" width="300px" height="200px">
                    </div>
                </div>
                <div class="card-body">
                    <div class="item-wrapper">
                        {{-- <h6 class="text-dark">{{ $value->title ?? '' }} | {{ $value->ranking }}</h6> --}}
                        <h6 class="text-dark">{{ $value->title ?? '' }}</h6>
                    </div>
                    <div>
                        <p style="font-size:0.7rem">{{ $value->name ?? '' }}</p>
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
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">  
                <div class="card-header">
                    <div class="float-left">
                        <h1>Proposal ({{ $data->count() }})</h1>
                    </div>
                </div>
                <hr class="bg-primary">
                <div class="card-body">
                    @foreach ($data as $key => $value)
                            <div class="d-flex justify-content-around">
                                <div>
                                    <a class="my-25" href="javascript: void(0);">
                                        <img src="{{ asset('uploads/images/'.$value->vacancy->biography->user->image) }}" alt="users avatar" class="users-avatar-shadow rounded" height="90" width="90">
                                    </a>
                                </div>
                                <div>
                                    <h6>{{ $value->vacancy->title ?? '' }}</h6>
                                    <p>{{ $value->vacancy->biography->name ? $value->vacancy->biography->name : $value->vacancy->biography->user->name }}</p>
                                </div>
                                <p>Terkirim {{ $value->created_at->format('d-m-Y') }}</p>
                                @php
                                    $chip = $value->status == 'waiting' ? 'warning' : ($value->status == 'approved' ? 'primary' : 'danger');
                                @endphp
                                <div>
                                    <div class="chip chip-{{ $chip }}">
                                        <div class="chip-body">
                                            <div class="chip-text">{{ $value->status ?? '' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <a class="btn-modal" href="javascript:void(0)" data-href="{{ route('applicant.detail', [$value->id]) }}" data-container=".my-modal">Detail</a>
                            </div>
                    @if(auth()->user()->vapplicant) <hr> @endif
                    @endforeach
                </div>  
                </div>
            </div>
        </div>
    </section>
@endif
<div class="modal fade my-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
<div class="modal fade child-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
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