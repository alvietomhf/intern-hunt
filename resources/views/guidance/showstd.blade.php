@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
@endsection

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
<div id="user-profile">
  <section id="profile-info">
    <div class="row">
        <div class="col-12">
            <div class="profile-header mb-2">
                <div class="relative">
                    <div class="cover-container">
                        <img class="img-fluid bg-cover rounded-0 w-100" style="height: 20rem" src="{{ $data->student->banner ? asset('uploads/images/'.$data->student->banner) : asset('assets/images/smkn1banner.jpg') }}" alt="User Profile Image">
                    </div>
                    <div class="profile-img-container d-flex align-items-center justify-content-between">
                        <img src="{{ asset('uploads/images/'.$data->student->image) }}" class="rounded-circle img-border box-shadow-1" alt="Card image">
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center profile-header-nav">
                        <div class="mt-5 ml-2">
                            <h1>{{ $data->student->name }}</h1>
                            <h6>Siswa di {{ $data->student->schname }}</h6>
                            <p>{{ $data->student->biography->description ?? '' }}</p>
                            <h6 class="mb-0">Bergabung:</h6>
                            <p>{{ $data->student->created_at->format('d, F Y') }}</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">  
              <div class="card-header">
                  <div class="float-left">
                    <h1>Pengalaman {{ $data->student->name }}</h1>
                  </div>
              </div>
              <hr class="bg-primary">
              <div class="card-body">
                @foreach ($experience as $key => $value)
                        <div class="d-flex justify-content-start">
                            <h4 class="ml-2">{{ $value->title ?? '' }}</h4>
                        </div>
                        <p class="ml-2">{{ $value->description ?? '' }}</p>
                        <p class="text-small text-muted ml-2">{{ $value->begin_at ?? '' }} @if($value->end_at != 'now') - {{ $value->end_at ?? '' }} @else sampai saat ini @endif</p>
                @if($data->student->experience) <hr> @endif
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
                    <h1>Portofolio {{ $data->student->name }}</h1>
                  </div>
              </div>
              <hr class="bg-primary">
              <div class="card-body">
                @foreach ($portfolio as $key => $value)
                        <div class="d-flex justify-content-start">
                            <div>
                                <h4 class="d-inline ml-2">{{ $value->title ?? '' }}</h4>
                                <span class="d-inline ml-1 badge badge-pill badge-light">{{ App\Tag::find($value->tag_id)->name ?? '' }}</span>
                            </div>
                        </div>
                        <p class="ml-2">{{ $value->description ?? '' }}</p>
                        <a class="ml-2" href="{{ asset('uploads/files/'. $value->file) }}" target="_blank" rel="noopener noreferrer">{{ $value->file ?? '' }}</a>
                @if($data->student->portfolio) <hr> @endif
                @endforeach
              </div>  
            </div>
        </div>
    </div>
  </section>
</div>
@endsection