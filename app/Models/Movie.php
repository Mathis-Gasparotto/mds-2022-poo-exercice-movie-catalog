<?php

namespace App\Models;

use App\Models\Scopes\MovieScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Title
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new MovieScope);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // V1
    //protected $table = 'movies';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    // V1
    /*public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movies_genres');
    }*/
}
