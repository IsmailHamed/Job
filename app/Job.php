<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Job
 *
 * @property int $id
 * @property string $jobTitle
 * @property string $jobContent
 * @property string|null $jobImage
 * @property int $caregoryId
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Job query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Job whereCaregoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Job whereJobContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Job whereJobImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Job whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Job whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Job extends Model
{
//    protected $fillable = [
//        'jobTitle', 'jobContent', 'jobImage'
//    ];
    public function category()
    {
        return $this->belongsTo('App\Category','caregory_id');
    }
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('message')->withTimestamps();
    }

}
