{{-- <div class="modal-dialog modal-lg" role="document">
  <form action="{{ route('guidance.store') }}" method="post">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Buat Grup</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" name="name" id="name" class="form-control" required placeholder="Nama Grup">
            </div>
            <div class="form-group">
              <label for="student">Siswa</label>
              <select class="select2 form-control tag-select2" name="students[]" id="student" multiple="multiple">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
  </form>
</div>

<script>
  $(document).ready(function() {
    $('.tag-select2').select2({
        dropdownAutoWidth: true,
        multiple: true,
        width: '100%',
        height: '30px',
        placeholder: "Pilih Siswa",
    })
    $('.select2-search__field').css('width', '100%')
  })
</script> --}}

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
                                      {{-- @foreach ($students as $key => $value)
                                          <div class="col-4 mt-1">
                                            <li class="list-group-item">
                                                <div class="media">
                                                    <input type="checkbox" name="siswas[]" data-id="{{ $key }}" id="siswa-{{ $key }}" value="{{ $value->id }}" class="mt-2 mr-1">
                                                    <img src="{{ asset('uploads/images/'.$value->image) }}" class="rounded-circle mr-2" alt="img-placeholder" height="50" width="50">
                                                    <div class="media-body">
                                                        <h5>{{ $value->name }}</h5>
                                                        <p style="font-size: 10px">{{ $value->department }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                          </div>
                                      @endforeach --}}
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
