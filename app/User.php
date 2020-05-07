<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class User extends Authenticatable
{
    use Notifiable;
    use HasTranslations;

    public $translatable = ['description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','subname','center','description', 'direction','location'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Offer created by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    /**
     *  offer where user registered
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function registered(){
        return $this->belongsToMany('App\Offer::Class', 'registered', 'user_id', 'offer_id');
    }


    /**
     * tipes preferred for used
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function preferred(){
        return $this->belongsToMany('App\Type::Class', 'preferred_types', 'user_id', 'type_id');

    }

    /**
     * Rating of a user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings(){
        return $this->HasMany('App\Rating::Class', 'rating_to', 'id');
    }
    /**
     * user Rated
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rated(){
        return $this->HasMany('App\Rating::Class', 'rating_by', 'id');
    }



}
