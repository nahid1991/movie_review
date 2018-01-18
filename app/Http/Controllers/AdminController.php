<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QueryHandlers\MovieQueries;
use App\DataTables\MoviesDataTable;

class AdminController extends Controller
{
    protected $movies;

    public function __construct(MovieQueries $movies)
    {
        $this->movies=$movies;
    }

    public function index(MoviesDataTable $dataTable) {
        $movies = $this->movies->moviesWithPagination();
        return $dataTable->render('admin.index');
    }
}
