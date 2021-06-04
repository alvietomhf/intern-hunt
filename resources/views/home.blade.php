@extends('layouts.app2')

@section('content')
<section id="dashboard-analytics">
    @include('flash::message')  
    <div class="row d-flex justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card {{ $bg }} text-white">
                <div class="card-content">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/images/elements/decore-left.png') }}" class="img-left" alt="card-img-left">
                        <img src="{{ asset('assets/images/elements/decore-right.png') }}" class="img-right" alt="card-img-right">
                        <div class="avatar avatar-xl {{ $bg }} shadow mt-0">
                            <div class="avatar-content">
                                <i class="feather {{ $icon }} white font-large-1"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h1 class="mb-2 text-white">{{ $title }}</h1>
                            <p class="m-auto w-75">{{ $message }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
@endsection
