@extends('layouts.auth')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="row flexbox-container">
                <div class="col-xl-8 col-10 d-flex justify-content-center">
                    <div class="card bg-authentication rounded-0 mb-0">
                        <div class="row m-0">
                            <div class="col-lg-6 col-12 p-0">
                                <div class="card rounded-0 mb-0 p-2">
                                    <div class="card-header pt-50 pb-1">
                                        <div class="card-title">
                                            <h4 class="mb-0">Sign Up</h4>
                                        </div>
                                    </div>
                                    <p class="px-2">Isi form di bawah ini untuk membuat akun baru.</p>
                                    <div class="card-content">
                                        <div class="card-body pt-0">
                                            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-label-group" id="form-status">
                                                    <fieldset class="form-group">
                                                        <select oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                        oninput="this.setCustomValidity('')" required class="form-control" id="status" name="status" autofocus>
                                                        <option disabled selected value="">Pilih</option>
                                                        <option value="siswa" @if (old('status') == "siswa") {{ 'selected' }} @endif>Siswa</option>
                                                        <option value="guru" @if (old('status') == "guru") {{ 'selected' }} @endif>Guru</option>
                                                        <option value="industri" @if (old('status') == "industri") {{ 'selected' }} @endif>Industri</option>
                                                        </select>
                                                    </fieldset>
                                                    <label for="status">Status</label>
                                                </div>
                                                <div class="form-label-group" id="form-name">
                                                    <input oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                    oninput="this.setCustomValidity('')" type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                    <label for="name">Nama</label>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                </div>
                                                <div class="form-label-group" id="form-username">
                                                    <input oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                    oninput="this.setCustomValidity('')" type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                                    <label for="username">Username</label>
                                                    @error('username')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="feather icon-at-sign"></i>
                                                    </div>
                                                </div>
                                                <div class="form-label-group" id="form-address">
                                                    <input oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                    oninput="this.setCustomValidity('')" type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat" value="{{ old('address') }}" required autocomplete="address" autofocus>
                                                    <label for="address">Alamat</label>
                                                    @error('address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="feather icon-map"></i>
                                                    </div>
                                                </div>
                                                <div class="form-label-group" id="form-phone">
                                                    <input oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                    oninput="this.setCustomValidity('')" type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Nomor HP" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                                    <label for="phone">Nomor HP</label>
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="feather icon-phone"></i>
                                                    </div>
                                                </div>
                                                <div class="form-label-group" id="form-schname">
                                                    <input oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                    oninput="this.setCustomValidity('')" type="text" id="schname" name="schname" class="form-control @error('schname') is-invalid @enderror" placeholder="Sekolah" value="{{ old('schname') }}" required autocomplete="schname" autofocus>
                                                    <label for="schname">Sekolah</label>
                                                    @error('schname')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="feather icon-map-pin"></i>
                                                    </div>
                                                </div>
                                                <div class="form-label-group" id="form-department">
                                                    <input oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                    oninput="this.setCustomValidity('')" type="text" id="department" name="department" class="form-control @error('department') is-invalid @enderror" placeholder="Jurusan" value="{{ old('department') }}" required autocomplete="department" autofocus>
                                                    <label for="department">Jurusan</label>
                                                    @error('department')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="feather icon-shield"></i>
                                                    </div>
                                                </div>
                                                <div class="form-label-group" id="form-email">
                                                    <input oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                    oninput="this.setCustomValidity('')" type="email" id="inputEmail" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                                                    <label for="inputEmail">Email</label>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="feather icon-mail"></i>
                                                    </div>
                                                </div>
                                                <div class="form-label-group" id="form-password">
                                                    <input oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                    oninput="this.setCustomValidity('')" type="password" id="inputPassword" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password">
                                                    <label for="inputPassword">Password</label>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="feather icon-lock"></i>
                                                    </div>
                                                </div>
                                                <div class="form-label-group" id="form-password-confirm">
                                                    <input oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                    oninput="this.setCustomValidity('')" type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required autocomplete="new-password">
                                                    <label for="password_confirmation">Confirm Password</label>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-lock"></i>
                                                    </div>
                                                </div>
                                                <div class="form-label-group" id="form-image">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputGroupFile01" name="image" required>
                                                            <label class="custom-file-label" for="inputGroupFile01">Pilih Foto</label>
                                                            @error('image')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                </div>
                                                <a href="{{ route('login') }}" class="btn btn-outline-primary float-left btn-inline mb-50">Login</a>
                                                <button type="submit" class="btn btn-primary float-right btn-inline mb-50">Register</a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="login-footer">
                                        <div class="divider">
                                            <div class="divider-text">Copyright &copy; 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                                <img src="{{ asset('assets/images/pages/register.jpg') }}" alt="branding logo">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        let schname = $('#form-schname')
        let department = $('#form-department')
        let email = $('#form-email')

        $('#form-schname, #form-department, #form-email').remove()

        if($('#status').val() === 'siswa'){
            $('#form-schname, #form-department, #form-email').remove()
            schname.insertBefore('#form-password')
            department.insertBefore('#form-password')
        }
        if($('#status').val() === 'guru'){
            $('#form-schname, #form-department, #form-email').remove()
            schname.insertBefore('#form-password')
        }
        if($('#status').val() === 'industri'){
            $('#form-schname, #form-department, #form-email').remove()
            email.insertBefore('#form-password')
        }

        $('#status').change(function() {
            if($(this).val() === 'siswa'){
                $('#form-schname, #form-department, #form-email').remove()
                schname.insertBefore('#form-password')
                department.insertBefore('#form-password')
            }
            if($(this).val() === 'guru'){
                $('#form-schname, #form-department, #form-email').remove()
                schname.insertBefore('#form-password')
            }
            if($(this).val() === 'industri'){
                $('#form-schname, #form-department, #form-email').remove()
                email.insertBefore('#form-password')
            }
        })
    })
</script>
@endsection
