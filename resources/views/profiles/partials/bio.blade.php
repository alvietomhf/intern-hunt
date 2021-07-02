<div class="row">
  <div class="col-12">
      <div class="profile-header mb-2">
          <div class="relative">
              <div class="cover-container">
                  <img class="card-img img-fluid bg-cover rounded-0 w-100" style="height: 20rem" src="{{ auth()->user()->banner ? asset('uploads/images/'.auth()->user()->banner) : asset('assets/images/smkn1banner.jpg') }}" alt="User Profile Image">
                  <div class="card-img-overlay overflow-hidden">
                      <div class="row d-flex justify-content-end">
                        <button data-href="{{ route('banner.edit') }}" data-container=".my-modal" class="btn btn-primary mr-2 btn-modal"><i class="fa fa-pencil-square-o"></i> Atur Banner</button>
                      </div>
                </div>
              </div>
              <div class="profile-img-container d-flex align-items-center justify-content-between">
                  <img src="{{ asset('uploads/images/'.auth()->user()->image) }}" class="rounded-circle img-border box-shadow-1" alt="Card image">
                  <div class="float-right">
                      @if(!$biography)
                      <button type="button" class="btn btn-modal btn-icon btn-icon rounded-circle btn-primary mr-1" data-href="{{ route('biography.create') }}" data-container=".my-modal">
                          <i class="feather icon-plus cursor-pointer" title="Tambah"></i>
                      </button>
                      @else
                      <button type="button" class="btn btn-modal btn-icon btn-icon rounded-circle btn-primary mr-1" data-href="{{ route('biography.edit', [$biography->id]) }}" data-container=".my-modal">
                          <i class="feather icon-edit-2 cursor-pointer" title="Edit"></i>
                      </button>
                      @endif
                      <a type="button" class="btn btn-icon btn-icon rounded-circle btn-primary" href="{{ route('home.setting') }}">
                          <i class="feather icon-settings"></i>
                      </a>
                  </div>
              </div>
          </div>
          <div class="d-flex justify-content-between align-items-center profile-header-nav">
                  <div class="mt-5 ml-2">
                      @if(auth()->user()->hasRole('siswa') || auth()->user()->hasRole('guru'))
                      <h1>{{ auth()->user()->name }}</h1>
                      @else
                      <h1>{{ auth()->user()->biography->name ? auth()->user()->biography->name : auth()->user()->name }}</h1>
                      @endif
                      @if(auth()->user()->hasRole('siswa'))
                      <h6>Siswa di {{ auth()->user()->schname }}</h6>
                      @elseif(auth()->user()->hasRole('guru'))
                      <h6>Guru di {{ auth()->user()->schname }}</h6>
                      @endif
                      <p>{{ $biography->description ?? '' }}</p>
                      @if(auth()->user()->hasRole('industri'))
                      <h6 class="mb-0">Email:</h6>
                      <p>{{ $biography->email ?? '-' }}</p>
                      <h6 class="mb-0">Alamat:</h6>
                      <p>{{ $biography->address ?? '-' }}</p>
                      <h6 class="mb-0">No HP:</h6>
                      <p>{{ $biography->phone ?? '-' }}</p>
                      @endif
                      <h6 class="mb-0">Bergabung:</h6>
                      <p>{{ auth()->user()->created_at->format('d, F Y') }}</p>
                  </div>
          </div>
      </div>
  </div>
</div>