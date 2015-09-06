<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['', '', ''];

    /**
     * The relationship this model has with the User
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        $this->belongsTo('App\User');
    }

}
