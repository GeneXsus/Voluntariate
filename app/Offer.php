<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Offer extends Model
{
    use HasTranslations;

    public $translatable = ['name','description','description_short'];

    protected $fillable = ['name','description','description_short','init_date','end_date','places','location','center','user_id', 'type_id','closed'];



    /**
     * user was created the offer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Type of a offer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     *  Users registered in the offer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function registered(){
        return $this->belongsToMany('App\User', 'registereds', 'offer_id', 'user_id');
    }

    public function path(){
        return route('offers.show',$this);
    }

    /**
     * Offer created by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function message()
    {
        return $this->hasMany(Message::class);
    }
}
