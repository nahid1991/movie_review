@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="display: inline-flex">Movies</div>
                    <a href="/admin/movies/create" class="btn btn-sm btn-primary pull-right" style="margin: 5px">Add New Movie</a>
                </div>
                {!! $dataTable->table() !!}
            </div>
        </div>
    </div>
    {!! $dataTable->scripts() !!}
    <script src="{{ asset('js/star-rating.js') }}"></script>
    <script>
        $(".rating").rating({displayOnly: true});
    </script>
@endsection