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
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>{{$movie->title}}</h2></div>
                </div>
                <div class="panel-body">
                    <p>{{$movie->description}}</p>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/star-rating.js') }}"></script>
    <script>
        $(".rating").rating({displayOnly: true});
    </script>
@endsection
