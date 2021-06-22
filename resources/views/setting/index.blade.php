@extends('layouts.app2')

@section('content')
    <!-- account setting page start -->
    @include('flash::message')
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                            <i class="feather icon-globe mr-50 font-medium-3"></i>
                            Umum
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                            <i class="feather icon-lock mr-50 font-medium-3"></i>
                            Keamanan
                        </a>
                    </li>
                </ul>
            </div>
            <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                    <form action="{{ route('home.updateSetting') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        {{-- <div class="media">
                                            <a href="javascript: void(0);">
                                                <img src="{{ asset('uploads/images/'.$data->image) }}" class="rounded mr-75" alt="profile image" height="64" width="64">
                                            </a>
                                            <div class="media-body mt-75">
                                                <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                    <input type="file" name="image" id="account-upload">
                                                </div>
                                                <p class="text-muted ml-75 mt-50"><small>Allowed JPG, JPEG or PNG. Max
                                                        size of
                                                        800kB</small></p>
                                            </div>
                                        </div> --}}
                                        <div class="media">
                                            <a href="javascript: void(0);">
                                                <img src="{{ asset('uploads/images/'.$data->image) }}" class="rounded mr-75" alt="profile image" height="64" width="64">
                                            </a>
                                            <div class="media-body mt-75">
                                                <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                    <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">Upload new photo</label>
                                                    <input type="file" name="image" id="account-upload" hidden>
                                                    <small id="filename" class="ml-2"></small>
                                                </div>
                                                <p class="text-muted ml-75 mt-50"><small>Allowed JPG, JPEG or PNG.</small></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="name">Nama</label>
                                                        <input type="text" name="name" id="name" value="{{ $data->name ?? '' }}" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="username">Username</label>
                                                        <input type="text" name="username" id="username" value="{{ $data->username ?? '' }}" class="form-control" disabled required>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($data->hasRole('siswa'))
                                                @include('setting.partials.siswa')
                                            @elseif ($data->hasRole('guru'))
                                                @include('setting.partials.guru')
                                            @else
                                                @include('setting.partials.industri')
                                            @endif
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                    <form action="{{ route('home.updatePassword') }}" method="post">
                                    @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-old-password">Old Password</label>
                                                        <input type="password" name="old_password" class="form-control" id="account-old-password" required placeholder="Old Password" data-validation-required-message="This old password field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-new-password">New Password</label>
                                                        <input type="password" name="password" id="account-new-password" class="form-control" placeholder="New Password" required data-validation-required-message="The password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-retype-new-password">Retype New
                                                            Password</label>
                                                        <input type="password" name="con_password" class="form-control" required id="account-retype-new-password" data-validation-match-match="password" placeholder="New Password" data-validation-required-message="The Confirm password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
                                                <button type="reset" class="btn btn-outline-warning">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- account setting page end -->


@endsection

@section('js')
<script>
$(document).ready(function() {
    $('#account-upload').change(function() {
        var filename = $('input[type=file]').val().split('\\').pop()
        var lastIndex = filename.lastIndexOf("\\")  
        $('#filename').text(filename)
    })
})
</script>
@endsection
