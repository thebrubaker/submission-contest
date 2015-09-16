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
    protected $fillable = ['email'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function submit(Submission $submission)
    {
        return $this->submissions()->save($submission);
    }

    /**
     * The relationship this model has with a Submission
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }

    /**
     * The relationship this model has with a Profile
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function profile()
    {
        return $this->hasOne('App\Profile');
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

    public function voted($submission)
    {
        return Vote::where('submission_id', $submission->id)
            ->where('user_id', $this->id)
            ->first();
    }

    public function castVote(Submission $submission)
    {
        $voted = $this->voted($submission);
        if(!$voted) {
            ++$submission->vote_cache;
            $submission->save();
            return $this->votes()->save($submission);
        }
        $voted->increment('value');
        ++$submission->vote_cache;
        return $submission->save();
    }

    public function canVote(Submission $submission)
    {
        return true;
    }
}
