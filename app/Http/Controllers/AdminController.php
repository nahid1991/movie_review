<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QueryHandlers\MovieQueries;

class AdminController extends Controller
{
    protected $movies;

    public function __construct(MovieQueries $movies)
    {
        $this->movies=$movies;
    }

    public function index() {
        $movies = $this->movies->moviesWithPagination();
        return view('admin.index', compact('movies'));
    }
}
