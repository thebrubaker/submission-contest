<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'submissions';

    /**
     * The attributes that have default values on Model creation.
     *
     * @var array
     */
    protected $attributes = ['value' => 1];

    /**
     * The relationship this model has with the User
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        $this->belongsTo('App\User');
    }

    /**
     * Query the submission's votes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function votes()
    {
        return $this->belongsToMany('App\User', 'votes')->withTimestamps()->withPivot('value');
    }

}
