<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{


    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['message','chat_id'];

    /**
     * A message belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userSended()
    {
        return $this->belongsTo(User::class, 'rating_by', 'id');;
    }

    /**
     * A message belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userReceived()
    {
        return $this->belongsTo(User::class, 'rating_by', 'id');
    }



    /**
     * A message belong to a offer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

}
