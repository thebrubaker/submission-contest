<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'is_admin'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The relationship this model has with a Submission
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function submission()
    {
        $this->hasOne('App\Submission');
    }

    /**
     * The relationship this model has with a Profile
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function profile()
    {
        $this->hasOne('App\Profile');
    }

    /**
     * Query the user's votes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function votes()
    {
        return $this->belongsToMany('App\Submission', 'votes')->withTimestamps()->withPivot('value');
    }
}
