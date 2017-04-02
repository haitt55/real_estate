<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PricesPolicies extends Model
{
	protected $table = 'prices_policies';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'id' , 'project_id' , 'slug' , 'content' , 'page_title' , 'meta_keyword' , 'meta_description' , 'created_at' , 'updated_at',
	];
	
	
}
