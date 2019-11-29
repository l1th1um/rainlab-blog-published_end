<?php namespace Arozie\Blogpublishedend\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class PostsAddPublishedEnd extends Migration
{

    public function up()
    {
       Schema::table('rainlab_blog_posts', function($table)
        {
            $table->timestamp('published_end_at')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('rainlab_blog_posts', 'published_end_at')) {
            Schema::table('rainlab_blog_posts', function ($table) {
                $table->dropColumn('published_end_at');
            });
        }
    }

}
