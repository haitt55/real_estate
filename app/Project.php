<?php
/**
 * Created by PhpStorm.
 * User: haitt
 * Date: 4/1/2017
 * Time: 4:16 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'main_project_id', 'project_name', 'project_image_logo', 'project_image_header', 'project_image_ads', 'project_image_ads1', 'is_current',
        'description',
        'page_title', 'meta_keyword', 'meta_description'
    ];

    public function main_project()
    {
        return $this->belongsTo('App\MainProject', 'main_project_id');
    }

    /**
    * Get the position record associated with the user.
    */
    public function position()
    {
        return $this->hasOne('App\Position', 'project_id', 'id');
    }

    /**
     * Get the customer record associated with the user.
     */
    public function customers()
    {
        return $this->hasMany('App\Position', 'project_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Images', 'project_id', 'id');
    }
}