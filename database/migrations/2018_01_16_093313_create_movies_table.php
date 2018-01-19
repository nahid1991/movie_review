<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('cover_image');
            $table->decimal('avg_rating', 2, 1)->default(0);
            $table->text('main_actors')->nullable();
            $table->date('release_date')->nullable();
            $table->string('producer')->nullable();
            $table->string('director')->nullable();
            $table->enum('genre', ['thriller', 'action', 'romantic', 'comedy', 'sci-fi', 'horror', 'others'])->default('others');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
