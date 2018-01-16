@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Movies</div>
                </div>
                <div class="panel-body">
                    <a href="#">
                        <div class="card">
                            <div class="poster" style="background-image: url('https://i.pinimg.com/736x/fd/5e/66/fd5e662dce1a3a8cd192a5952fa64f02--classic-poster-classic-movies-posters.jpg');">
                            </div>
                            <div class="card-container">
                                <h4><b>John Doe</b></h4>
                                <input type="text" class="rating" data-size="sm">
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/star-rating.js') }}"></script>
    <script>
        $(".rating").rating({displayOnly: true});
    </script>
@endsection