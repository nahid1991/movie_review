<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QueryHandlers\MovieQueries;

class MovieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $movies;

    public function __construct(MovieQueries $movies)
    {
        $this->movies=$movies;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = $this->movies->moviesWithPagination();
        return view('user.movies', compact('movies'));
    }

    public function show($id) {
        $movie = $this->movies->findMovieById($id);
        $userRating= $this->movies->findMovieRatingForUser($id);
        $ratings = $this->movies->movieRatings($id);
        return view('user.movie', compact('movie', 'userRating', 'ratings'));
    }

    public function landing() {
        if(\Auth::check()) {
            return redirect('/separate');
        } else {
            $movies = $this->movies->moviesWithPagination();
            return view('landing', compact('movies'));
        }
    }

    public function ratings($id) {
        $ratings = $this->movies->movieRatings($id);
        return view('partials.comments', ['ratings' => $ratings])->render();
    }
}
