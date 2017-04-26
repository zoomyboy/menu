<?php

namespacee Zoomyboy\Menu;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class Serviceprovider extends BaseServiceProvider {
	public function boot() {
		$this->loadMigrationsFrom(__DIR__.'/Migrations');
	}
}
