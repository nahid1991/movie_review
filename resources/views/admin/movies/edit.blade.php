@extends('layouts.admin.app')

@section('content')
    <style>
        input {
            margin-bottom: 10px;
        }

        textarea {
            margin-bottom: 10px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default text-center">
                    <a href="/admin" class="btn btn-sm btn-primary pull-left" style="margin: 5px">< Back</a>
                    <div class="panel-heading text-center" style="display: inline-flex"><b>({{$movie->title}}) - Edit</b></div>
                </div>
                <div class="panel-body">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
                    <form action="{{ action('AdminMoviesController@update', $movie->id) }}" method="post" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        {!! method_field('PUT') !!}
                        <div class="col-md-4 col-sm-12">
                            <label>Cover Image</label>
                            <img src="{{ asset('img/uploads/poster/'.$movie->cover_image) }}" id="cover_image_tag" width="300px"/>
                            <br>
                            <label for="cover_image">Change Image</label>
                            <input required type="file" name="cover_image" id="cover_image">
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <label for="title">Title</label>
                            <input required type="text" id="title" class="form-control" name="title" value="{{$movie->title}}">

                            <label for="description">Description (Story)</label>
                            <textarea required name="description" id="description" cols="30" rows="10" class="form-control">{{$movie->description}}</textarea>

                            <label for="genre">Genre</label>
                            @php
                                $genres = ['thriller', 'action', 'romantic', 'comedy', 'sci-fi', 'horror', 'others']
                            @endphp
                            <select name="genre" class="form-control">
                                @foreach($genres as $genre)
                                <option {{$movie->genre == $genre ? 'selected': ''}} value="{{$genre}}">{{ucwords($genre)}}</option>
                                @endforeach
                            </select>

                            <label for="main_actors">Main Actors</label>
                            <input type="text" name="main_actors" id="main_actors" class="form-control" value="{{$movie->main_actors}}">

                            <label for="director">Director</label>
                            <input type="text" name="director" id="director" class="form-control" value="{{$movie->director}}">

                            <label for="producer">Producer</label>
                            <input type="text" name="producer" id="producer" class="form-control" value="{{$movie->producer}}">

                            <label for="release_date">Release Date:</label>
                            <input type="text" name="release_date" class="release_date form-control" id="release_date"
                                   value="{{\Carbon\Carbon::parse($movie->release_date)->format('j F Y')}}">

                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('.release_date').datepicker({
            format: 'd MM yyyy'
        });
    </script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#cover_image_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#cover_image").change(function(){
            readURL(this);
        });
    </script>
@endsection