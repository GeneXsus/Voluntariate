<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $fillable = ['description','rate'];
    protected $primaryKey = ['rating_by', 'rating_to'];
    public $incrementing = false;

    /**
     * User was do rating
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userRated()
    {
        return $this->belongsTo('App\User::class', 'id', 'rating_by');
    }

    /**
     * User was rated
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userRating()
    {
        return $this->belongsTo('App\User::class', 'id', 'rating_to');
    }

}
