<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $fillable = ['rating_by', 'rating_to','description','rate'];
    protected $primaryKey = ['rating_by', 'rating_to'];
    public $incrementing = false;

    /**
     * user was do rating
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userRated()
    {
        return $this->belongsTo(User::class, 'rating_by', 'id');
    }

    /**
     * user was rated
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userRating()
    {
        return $this->belongsTo(User::class, 'rating_to', 'id');
    }

}
