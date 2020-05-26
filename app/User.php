<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Spatie\Translatable\HasTranslations;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable;
    use HasTranslations;
    use HasRoles;

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
    public function messagesSend()
    {

        return $this->hasMany(Message::class);
    }


    /**
     * Offer created by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messageRecived()
    {
        return $this->hasMany(Offer::class);
    }

    /**
     *  offer where user registered
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function registereds(){
        return $this->belongsToMany(Offer::class, 'registereds', 'user_id', 'offer_id')->withPivot('acepted');
    }
    /**
     *  offer where user registered and acepted
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function registeredsAcepted(){
        return $this->belongsToMany(Offer::class, 'registereds', 'user_id', 'offer_id')->wherePivot('acepted',1);
    }


    /**
     * tipes preferred for used
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function preferred(){
        return $this->belongsToMany(Type::class, 'preferred_types', 'user_id', 'type_id');

    }

    /**
     * Rating of a user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings(){
        return $this->HasMany(Rating::Class, 'rating_to', 'id');
    }


    /**
     * user Rated
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rated(){
        return $this->HasMany(Rating::Class, 'rating_by', 'id');
    }
    /**
     *  Value of Rating of a user
     * @return integer
     */

    public function ratingsValue(){
        $ratings=$this->ratings;
        $countRating=$ratings->count();
        if($countRating>0){
            $ratingsValue=0;

            foreach ($ratings as $rating){
                $ratingsValue=$ratingsValue+$rating->rate;

            }

            $ratingsValue=$ratingsValue/$countRating;
        }else{
            $ratingsValue=-1;
        }


        return $ratingsValue;

    }

    /**
     * Rating of a offer
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers(){
        return $this->HasMany(Offer::Class);
    }




}
