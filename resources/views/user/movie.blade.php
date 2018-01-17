@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="panel-body">
                    <div class="card" style="width: 100% !important">
                        <div class="poster" style="background-image: url('{{ asset('img/uploads/poster/'.$movie->cover_image) }}');">
                        </div>
                        <div class="card-container">
                            <h4><b>{{$movie->title}}</b></h4>
                            <input type="text" class="rating" data-size="sm" value="{{$movie->avg_rating}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="panel panel-default" style="margin-bottom: 0 !important">
                    <div class="panel-heading"><h2>{{$movie->title}}</h2></div>
                </div>
                <div class="panel-body" style="padding-top: 0px !important">
                    <h3>Story</h3>
                    <p>{{$movie->description}}</p>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>(Rate the movie)</h4>
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        <form method="post" action="{{url('/movies')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="movie_id" value="{{$movie->id}}">
                            <input type="text" required class="user-rating" data-size="sm"
                                   name="rating" value="{{$loggedUserRating ? $loggedUserRating->rating : 0.0}}">
                            <textarea name="comment" required
                                    class="form-control">{{$loggedUserRating && $loggedUserRating->comment !== null ? $loggedUserRating->comment : null}}</textarea>
                            <br>
                            <button type="submit" class="rate btn btn-sm btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Other Ratings:</h3>
                        <section class="ratings">
                            @include('partials.comments')
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/star-rating.js') }}"></script>
    <script>
        $(".rating").rating({displayOnly: true});
        $(".user-rating").rating({step: 1});

        $(function() {
            $(".others-rating").rating({displayOnly: true});
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');
                getRatings(url);
            });

            function getRatings(url) {
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('.ratings').html(data);
                    $(".others-rating").rating({displayOnly: true});
                }).fail(function () {
                    alert('Ratings could not be loaded.');
                });
            }
        });
    </script>
@endsection
