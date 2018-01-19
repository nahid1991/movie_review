@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="display: inline-flex">Movie Edit</div>
                    <a href="/admin" class="btn btn-sm btn-primary pull-left" style="margin: 5px">< Back</a>
                </div>
                <div class="panel-body">
                    <label for="release_date">Release Date:</label>
                    <input type="text" class="release_date form-control" id="release_date">
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(function(){
            $('.release_date').datepicker({
                format: 'dd M yyyy'
            });
        });
    </script>
@endsection