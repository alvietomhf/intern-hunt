@extends('layouts.app2')

@section('content')
<section id="dashboard-analytics">
    @if($not_acc == 'yes' && isset($applicant2))
    <div class="alert alert-warning" role="alert">
        Anda telah diundang oleh teman satu grup bimbingan prakerin anda! Klik tombol dibawah ini untuk konfirmasi!
        <div class="mt-1">
            <a type="button" class="btn btn-sm btn-action btn-modal btn-primary text-dark" data-status="menerima" data-href="{{ route('vacancy.action_custom', [$applicant2->id, 'approved']) }}">Terima</a>
            <a type="button" class="btn btn-sm btn-action btn-modal btn-danger text-white" data-status="menolak" data-href="{{ route('vacancy.action_custom', [$applicant2->id, 'rejected']) }}">Tolak</a>
        </div>
    </div>
    @endif
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

@section('js')
<script>
$('.btn-action').on('click', function(e){
      var btn = $(this);
      var status = btn.data('status');
      e.stopPropagation();
      Swal.fire({
          title: 'Anda yakin?',
          text: `Anda akan ${status} undangan ini!`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya Lakukan!'
      }).then((result) => {
          if (result.value) {
              $.ajax({
                  url: btn.data('href'),
                  method: 'POST',
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
