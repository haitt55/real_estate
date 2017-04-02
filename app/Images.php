<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
	protected $table = 'images';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'id' , 'project_id' , 'title' , 'image' , 'created_at' , 'updated_at',
	];
	
	
}
