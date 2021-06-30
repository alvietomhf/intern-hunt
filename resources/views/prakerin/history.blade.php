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
<section id="basic-datatable">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Jurnal</h4>
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <p class="card-text">Berisi jurnal siswa</p>
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($journal as $key => $value)
                                <tr>
                                    <td>{{ $value->title ?? '' }}</td>
                                    <td>{{ $value->description ?? '' }}</td>
                                    <td>{{ date('d/m/Y', strtotime($value->date)) ?? '' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">File Siswa</h4>
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <p class="card-text">Berisi file siswa</p>
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>File</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($student_file as $key => $value)
                                <tr>
                                    <td>{{ $value->title ?? '' }}</td>
                                    <td>{{ $value->description ?? '' }}</td>
                                    <td>
                                      <a href="{{ asset('uploads/files/'.$value->file) ?? '' }}" target="_blank">Lihat</a>
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($value->created_at)) ?? '' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      @if(isset($vacancy->biography))
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">File Industri</h4>
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <p class="card-text">Berisi file industri</p>
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>File</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($industry_file as $key => $value)
                                <tr>
                                    <td>{{ $value->title ?? '' }}</td>
                                    <td>{{ $value->description ?? '' }}</td>
                                    <td>
                                      <a href="{{ asset('uploads/files/'.$value->file) ?? '' }}" target="_blank">Lihat</a>
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($value->created_at)) ?? '' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      @endif
  </div>
</section>
<div class="modal fade my-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
@endsection