<?php

namespace App;

use App\Utilities\ImageUtility;
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
     * The attributes that are mass assignable on the Model
     * @var array
     */
    protected $fillable = array('caption', 'location', 'image');

    /**
     * Set the submission's image.
     *
     * @param  string  $value
     * @return string
     */
    public function setImageAttribute($image)
    {
        $image_path = ImageUtility::create($image);
        $thumbnail_path = ImageUtility::thumbnail($image);
        $this->attributes['image_path'] = $image_path;
        $this->attributes['thumbnail_path'] = $thumbnail_path;
    }

    /**
     * The relationship this model has with the User
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
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
