<?php
/**
 * Created by PhpStorm.
 * User: haitt
 * Date: 4/1/2017
 * Time: 4:13 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'email', 'full_name', 'phone_number', 'message', 'is_new',
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