<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilities extends Model
{
	protected $table = 'utilities';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'id' , 'project_id' , 'title' , 'slug' , 'content' , 'page_title' , 'meta_keyword' , 'meta_description' , 'created_at' , 'updated_at',
	];
	
	
}
