@php
    $genres = ['thriller', 'action', 'romantic', 'comedy', 'sci-fi', 'horror', 'others']
@endphp

<ul>
    <li class="{{!isset($genre) || empty($genre) ? 'active': ''}}"><a href="/search?keyword={{isset($keyword) ? $keyword: ''}}&genre=">
        <h4><b>All</b></h4>
    </a></li>
@foreach($genres as $g)
    <li class="{{isset($genre) && $genre == $g ? 'active': ''}}">
        <a href="/search?keyword={{isset($keyword) ? $keyword: ''}}&genre={{$g}}">
            <h4><b>{{ucwords($g)}}</b></h4>
        </a>
    </li>
@endforeach
</ul>