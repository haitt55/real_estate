<?php
/**
 * Created by PhpStorm.
 * User: haitt
 * Date: 4/1/2017
 * Time: 4:09 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Progress extends Model
{
	use Sluggable;
    protected $table = 'progress';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'title', 'slug', 'content',
        'page_title', 'meta_keyword', 'meta_description'
    ];
    public function sluggable()
    {
    	return [
    			'slug' => [
    					'source' => 'title'
    			]
    	];
    }

    /**
     * Get the project that owns the position.
     */
    public function project()
    {
        return $this->belongsTo('App\MainProject', 'project_id');
    }
    public function getRouteKeyName()
    {
    	return 'slug';
    }
}
