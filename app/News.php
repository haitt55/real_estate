<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	protected $table = 'news';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'id' , 'project_id' , 'title' , 'slug' , 'content' , 'published' , 'page_title' , 'meta_keyword' , 'meta_description' , 'created_at' , 'updated_at',
	];
	
	
}
