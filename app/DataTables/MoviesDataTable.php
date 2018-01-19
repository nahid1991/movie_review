<?php

namespace App\DataTables;

use App\Models\Movie;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class MoviesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('genre', function($movie){
                return ucwords($movie->genre);
            })
            ->addColumn('action', function ($movie) {
                return view('partials.action', compact('movie'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Movie $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Movie $movies)
    {
        return $movies->query()->orderBy('release_date', 'desc')->select('id', 'title', 'main_actors', 'director', 'producer', 'release_date', 'genre');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters([$this->getBuilderParameters(),
                        'buttons' => [
                             'reload',
                        ]
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'title',
            'main_actors',
            'director',
            'producer',
            'release_date',
            'genre'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Movies_' . date('YmdHis');
    }
}
