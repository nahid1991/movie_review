@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Movies</div>
                </div>
                <div class="panel-body">
                    <div class="panel-body">
                        @foreach($movies as $movie)
                            <a href="/movies/{{$movie->id}}">
                                <div class="card">
                                    <div class="poster" style="background-image: url('{{ asset('img/uploads/poster/'.$movie->cover_image) }}');">
                                    </div>
                                    <div class="card-container">
                                        <h4><b>{{$movie->title}}</b></h4>
                                        <input type="text" class="rating" data-size="sm" value="{{$movie->avg_rating}}">
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="panel-body" style="text-align: center">
                        {{ $movies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/star-rating.js') }}"></script>
    <script>
        $(".rating").rating({displayOnly: true});
    </script>
@endsection
