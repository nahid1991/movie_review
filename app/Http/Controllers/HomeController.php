<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QueryHandlers\MovieQueries;

class HomeController extends Controller
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
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = $this->movies->moviesWithPagination();
        return view('user.home', compact('movies'));
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
