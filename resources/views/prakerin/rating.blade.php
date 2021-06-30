@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
@endsection

@section('content')
  <section id="basic-vertical-layouts">
    <div class="row match-height justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">Rating</h4>
                    <h6 class="mt-1">Prakerin {{ $vacancy->title }} di {{ $vacancy->biography->name ? $vacancy->biography->name : $vacancy->biography->user->name }}</h6>

                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" action="{{ route('rating.store', [$applicant->id]) }}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="rateyo" id= "rating"
                                            data-rateyo-rating="0"
                                            data-rateyo-num-stars="5">
                                            </div>
                                            <input type="hidden" name="rating" value="0" required>
                                        </div>
                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>
    $(function () {
        $(".rateyo").rateYo({fullStar: true}).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });
</script>
@endsection