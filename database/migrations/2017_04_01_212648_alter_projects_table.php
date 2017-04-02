<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->text('description')->nullable()->after('project_image_ads');
            $table->string('page_title')->nullable()->after('is_current');
            $table->string('meta_keyword')->nullable()->after('page_title');
            $table->string('meta_description')->nullable()->after('meta_keyword');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('page_title');
            $table->dropColumn('meta_keyword');
            $table->dropColumn('meta_description');
        });
    }
}
