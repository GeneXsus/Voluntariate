<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Type extends Model
{
    use HasTranslations;
    public $translatable = ['name','description'];
    //
    protected $fillable=['name','description'];



    /**
     * Offer with this type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }


    /**
     * users has prefered
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function preferred(){
        return $this->belongsToMany('App\Type::Class', 'preferred_types', 'type_id', 'user_id');

    }

}
