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
    public function messages()
    {
        return $this->hasMany(Message::class);
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

    /**
     * See if him si last of talk in chat
     * @return Boolean
     */
    public function unresponded($chatId){
        $unresponded=false;
        $last_chat=    Message::where('chat_id',$chatId)->orderBy('updated_at','Desc')->first();
        $unresponded= ($last_chat && $last_chat['user_id']== $this->id)?true:false;

        return $unresponded;
    }


    /**
     *  Buscador
     */
    public function scopeSearcher($query,$text){

        $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
        $text = strtr( $text, $unwanted_array );
        $stext= strtolower("%".$text."%");



         $query->where( function ( $query ) use ( $stext ) {

            $query->whereRaw('LOWER(`name`) like ?', array($stext))
                ->orWhereRaw('LOWER(`subname`) like ?', array($stext))
                ->orWhereRaw('LOWER(`center`) like ?', array($stext))
                ->orWhereRaw('LOWER(`description`) like ?', array($stext))
                ->orWhereRaw('LOWER(`location`) like ?   ', array($stext))
                ->orWhereRaw('LOWER(`email`) like ?   ', array($stext));


        });
    }




}
