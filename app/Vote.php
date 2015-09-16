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
    protected $table = 'votes';

    /**
     * The default attributes of a Vote model
     * @var array
     */
    protected $attributes = ['value' => 1];

    /**
     *  Query the users that belong to the vote.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * The relationship this model has with the User
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function submissions()
    {
        return $this->belongsToMany('App\Submission');
    }

}
