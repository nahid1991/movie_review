<?php

namespace App\Http\Controllers;

use App\QueryHandlers\MovieQueries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

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

    public function show($id, Request $request) {
        try {
            $movie = $this->movies->findMovieById($id);
            $otherUsersRatings = $this->movies->otherUsersRatings($id);
            $loggedUserRating= $this->movies->findMovieRatingForUser($id);
            if($request->ajax()) {
                return view('partials.comments', ['otherUsersRatings' => $otherUsersRatings])->render();
            }
            return view('user.movie', compact('movie', 'loggedUserRating', 'otherUsersRatings'));
        } catch(Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function store(Request $request) {
        $data = [
                    'user_id' => Auth::user()->id,
                    'movie_id' => $request->input('movie_id'),
                    'rating' => $request->input('rating'),
                    'comment' => $request->input('comment'),
                ];

        $saved = $this->movies->storeOrUpdateMovieReview($data);

        if($saved) {
            $request->session()->flash('alert-success', 'Rating was successful added!');
            return redirect()->back();
        }

        $request->session()->flash('alert-danger', 'An error occured!');
        return redirect()->back();
    }

    public function landing() {
        if(\Auth::check()) {
            return redirect('/separate');
        } else {
            $movies = $this->movies->moviesWithPagination();
            return view('landing', compact('movies'));
        }
    }
}
