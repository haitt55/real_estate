<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class News extends Model
{
	use Sluggable;
	protected $table = 'news';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'id' , 'project_id' , 'title' , 'slug' , 'content' , 'published' , 'page_title' , 'meta_keyword' , 'meta_description' , 'created_at' , 'updated_at',
	];
	
	public function sluggable()
	{
		return [
				'slug' => [
						'source' => 'title'
				]
		];
	}
}
