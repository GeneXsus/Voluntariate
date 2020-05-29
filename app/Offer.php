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
    public function registereds(){
        return $this->belongsToMany(User::class, 'registereds', 'offer_id', 'user_id')->withPivot('acepted');
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

        $stext= htmlspecialchars($stext);
        return $query->where( function ( $query ) use ( $stext ) {
            $query->whereRaw('LOWER(`name`) like ?', array($stext))
                ->orWhereRaw('LOWER(`description_short`) like ?', array($stext))
                ->orWhereRaw('LOWER(`description`) like ?', array($stext))
                ->orWhereRaw('LOWER(`location`) like ?', array($stext));


        });
    }


}
