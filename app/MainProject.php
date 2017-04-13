<?php
/**
 * Created by PhpStorm.
 * User: haitt
 * Date: 4/1/2017
 * Time: 4:16 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainProject extends Model
{
    protected $table = 'main_projects';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_name', 'project_image_logo', 'project_image_header', 'project_image_ads', 'project_image_ads1', 'is_current',
        'description', 'page_title', 'meta_keyword', 'meta_description'
    ];

    /**
    * Get the position record associated with the user.
    */
    public function project()
    {
        return $this->hasMany('App\Position', 'main_project_id', 'id');
    }

    /**
     * Get the customer record associated with the user.
     */
    public function customers()
    {
        return $this->hasOne('App\Progress', 'main_project_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Images', 'project_id', 'id');
    }
}