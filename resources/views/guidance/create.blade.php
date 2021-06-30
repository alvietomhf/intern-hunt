@extends('layouts.app2')

@section('content')
<section id="basic-vertical-layouts">
  <div class="row match-height">
      <div class="col-12">
        @include('flash::message')
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Buat Grup</h4>
              </div>
              <div class="card-content">
                  <div class="card-body">
                      <form class="form form-vertical" action="{{ route('guidance.store') }}" method="post">
                        @csrf
                          <div class="form-body">
                              <div class="row">
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label for="first-name-vertical">Nama</label>
                                          <input type="text" id="first-name-vertical" class="form-control" name="name" placeholder="Nama Grup" required>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-group d-flex justify-content-lg-between">
                                      <label for="first-name-vertical">Pilih Siswa</label>
                                      <input type="text" name="search" id="search" placeholder="Cari Siswa">
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="row" id="databody">
                                    </div>
                                  </div>
                                  <div class="col-12">
                                      <button type="submit" class="btn btn-primary mr-1 mb-1 mt-2">Submit</button>
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
