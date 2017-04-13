<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_name')->unique();
            $table->string('project_image_header')->nullable();
            $table->string('project_image_logo')->nullable();
            $table->string('project_image_ads')->nullable();
            $table->string('project_image_ads1')->nullable();
            $table->smallInteger('is_current')->default(0);
            $table->text('description')->nullable();
            $table->string('page_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('main_projects', function (Blueprint $table) {
            Schema::dropIfExists('projects');
        });
    }
}
