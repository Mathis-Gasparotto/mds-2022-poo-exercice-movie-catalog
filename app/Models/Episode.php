<?php

namespace App\Models;

use App\Models\Scopes\EpisodeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Title
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new EpisodeScope);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // V1
    //protected $table = 'episodes';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    // V1
    /*public function genres()
    {
        return $this->belongsToMany(Genre::class, 'episodes_genres');
    }*/

    public function series()
    {
        return $this->belongsToMany(Title::class, 'titles_episodes', 'episode_id');
    }

}
