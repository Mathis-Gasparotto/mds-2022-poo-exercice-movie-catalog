<?php

namespace App\Models;

use App\Models\Scopes\SeriesScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Title
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new SeriesScope);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // V1
    //protected $table = 'series';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    // V1
    /*public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'series_genres');
    }*/

    public function episodes()
    {
        return $this->belongsToMany(Title::class, 'titles_episodes', 'title_id', 'episode_id')->withPivot('seasonNumber', 'episodeNumber');
    }

}
