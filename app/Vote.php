<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vote';

    /**
     *  Query the users that belong to the vote.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        $this->belongsToMany('App\User');
    }

    /**
     * The relationship this model has with the User
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function submissions()
    {
        $this->belongsToMany('App\Submission');
    }

}
