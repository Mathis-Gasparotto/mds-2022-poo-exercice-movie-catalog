<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'genres';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function movies()
    {
        return $this->belongsToMany(Title::class, 'titles_genres')->where('titleType', '=', 'movie');

        // V1
        //return $this->belongsToMany(Movie::class, 'movies_genres');
    }

    public function series()
    {
        return $this->belongsToMany(Title::class, 'titles_genres')->whereIn('titleType', ['tvSeries', 'tvMiniSeries']);

        // V1
        //return $this->belongsToMany(Series::class, 'series_genres');
    }

    public function episodes()
    {
        return $this->belongsToMany(Title::class, 'titles_genres')->where('titleType', '=', 'tvEpisode');

        // V1
        //return $this->belongsToMany(Episode::class, 'episodes_genres');
    }
}
