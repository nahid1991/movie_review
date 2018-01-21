@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Filter category</div>
                    <div class="panel-body">
                        @include('partials.categories')
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Showing results for Keyword: "{{isset($keyword) ? $keyword : ''}}" & Genre: "{{isset($genre) ? $genre : ''}}"</div>
                </div>
                <div class="panel-body">
                    @include('partials.movies')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/star-rating.js') }}"></script>
    <script>
        $(".rating").rating({displayOnly: true});
    </script>
@endsection