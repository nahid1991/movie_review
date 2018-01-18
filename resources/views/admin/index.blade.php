@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Movies</div>
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