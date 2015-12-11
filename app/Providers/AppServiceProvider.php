<?php namespace App\Providers;

use App\Repositories\ControlPanelLinkRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @param Guard $guard
	 */
	public function boot(Guard $guard, ControlPanelLinkRepository $links)
	{

        /**
         * Share the authenticated user with all views.
         */
        view()->composer('*', function ($view) use ($guard) {
            $view->with('current_user', $guard->user());
        });

        /**
         * Share the control panel links with all views.
         */
        view()->composer('*', function ($view) use ($links) {
            $view->with('control_panel_links', $links->sort('description')->all());
        });
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
