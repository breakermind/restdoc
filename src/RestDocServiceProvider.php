<?php

namespace RestDoc;

use Illuminate\Support\ServiceProvider;
use RestDoc\Doc;

class RestDocServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'restdoc');

		$this->app->singleton(Doc::class);
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'restdoc');

		if ($this->app->runningInConsole()) {

			$this->publishes([
				__DIR__ . '/../resources/views' => resource_path('views/vendor/restdoc'),
			], 'restdoc-views');

			$this->publishes([
				__DIR__ . '/../config/config.php' => config_path('restdoc.php'),
			], 'restdoc-config');

			$this->publishes([
				__DIR__ . '/../routes' => base_path('routes/restdoc')
			], 'restdoc-routes');

			// $this->publishes([
			// 	__DIR__ . '/../tests/RestDoc' => base_path('tests/RestDoc')
			// ], 'restdoc-tests');

		}
	}
}
