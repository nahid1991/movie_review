@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="panel-body">
                    <div class="card" style="width: 100% !important">
                        <div class="poster" style="background-image: url('{{$movie->cover_image}}');">
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
                        <input type="text" required class="user-rating" data-size="sm"
                               value="{{$userRating ? $userRating->rating : 0.0}}">
                        <textarea
                                class="form-control">{{$userRating && $userRating->comment !== null ? $userRating->comment : null}}</textarea>
                        <br>
                        <button type="button" class="rate btn btn-sm btn-primary">Submit</button>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Other Ratings:</h3>
                        {{--@if(count($ratings)>0)--}}
                            <section class="ratings">
                                {{--@include('partials.comments')--}}
                            </section>
                        {{--@endif--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/star-rating.js') }}"></script>
    <script>
        $(".rating").rating({displayOnly: true});
        $(".user-rating").rating();

        $(function() {
            $.ajax({
                url : '/movies/{{$movie->id}}/ratings'
            }).done(function (data) {
                $('.ratings').html(data);
                $(".other-rating").rating({displayOnly: true});
            }).fail(function () {
                alert('Ratings could not be loaded.');
            });

            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');
                getRatings(url);
//                window.history.pushState("", "", url);
            });

            function getRatings(url) {
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('.ratings').html(data);
                    $(".other-rating").rating({displayOnly: true});
                }).fail(function () {
                    alert('Ratings could not be loaded.');
                });
            }
        });
    </script>
@endsection
