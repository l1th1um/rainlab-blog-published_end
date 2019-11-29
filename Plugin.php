<?php namespace arozie\BlogPublishedEnd;

use System\Classes\PluginBase;
use \RainLab\Blog\Models\Post;

class Plugin extends PluginBase
{
    public $require = ['RainLab.Blog'];

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
        Post::extend(function ($model) {
            $model->addDynamicMethod('hasPublishedEnd', function () use ($model) {
                return true;
            });
            $model->addDynamicMethod('published_end_at', function () use ($model) {
                return $model->published_end_at;
            });
        });
        
        \Event::listen('backend.list.extendColumns', function ($widget) {
            // Only for the Posts controller
            if (( ! $widget->getController() instanceof \Rainlab\Blog\Controllers\Posts)) {
                return;
            }

            $widget->addColumns([
                                    'published_end_at' => [
                                        'label' => 'Published End',
                                        'type'  => 'date'
                                    ]
                                ]);
        });

        \Event::listen('backend.form.extendFields', function ($widget) {
            
            // Only for the blog post controller
            if (! $widget->getController() instanceof \RainLab\Blog\Controllers\Posts) {
                return;
            }
            
            // Only for the blog post model
            if (! $widget->model instanceof \RainLab\Blog\Models\Post) {
                return;
            }
            
            $widget->addSecondaryTabFields([
                'published_end_at' => [
                	'tab' 	  => 'rainlab.blog::lang.post.tab_manage',
                    'label'   => 'Published End',
                    'comment' => 'Select the Published End Date',
                    'type'    => 'datepicker'
                ]
            ]);
        });
    }

}
