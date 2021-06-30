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
<section id="basic-vertical-layouts">
  <div class="row match-height">
      <div class="col-12">
        @include('flash::message')
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Tambah Siswa ({{ $data->name ?? '' }})</h4>
              </div>
              <div class="card-content">
                  <div class="card-body">
                      <form class="form form-vertical" action="{{ route('guidance_s.store', [$data->slug]) }}" method="post">
                        @csrf
                          <div class="form-body">
                              <div class="row">
                                  <div class="col-12">
                                    <div class="form-group d-flex justify-content-between">
                                      <label for="first-name-vertical">Pilih Siswa</label>
                                      <input type="text" name="search" id="search" placeholder="Cari Siswa">
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="row" id="databody">
                                    </div>
                                  </div>
                                  <div class="col-12">
                                      <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection

@section('js')
<script>
  $(document).ready(function(){
  
   fetch_customer_data();
  
   function fetch_customer_data(query = '')
   {
    $.ajax({
     url:"{{ route('search.action') }}",
     method:'GET',
     data:{query:query},
     dataType:'json',
     success:function(data)
     {
      $('#databody').html(data.table_data);
     }
    })
   }
  
   $(document).on('keyup', '#search', function(){
    var query = $(this).val();
    fetch_customer_data(query);
   });
  });
  </script>
@endsection
