<?php
/**
 * Created by PhpStorm.
 * User: haitt
 * Date: 4/1/2017
 * Time: 4:09 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'positions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'title', 'slug', 'content',
        'page_title', 'meta_keyword', 'meta_description'
    ];

    /**
     * Get the project that owns the position.
     */
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }
}
