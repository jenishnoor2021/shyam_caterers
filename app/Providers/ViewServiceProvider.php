<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CuisineCategory;
use App\Models\Event;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Share data with the front header view
        View::composer(['front_includes.header', 'front_includes.sidebar'], function ($view) {
            $eventNames = Event::where('is_active', 1)->select('id', 'event_type')->get();
            $cusineCategoryNames = CuisineCategory::where('is_active', 1)->get();

            $view->with(compact('eventNames', 'cusineCategoryNames'));
        });
    }
}
