<?php

namespace App\Providers;

use App\Models\UPCalculator;
use App\Models\Tariffs;
use App\Policies\TariffsPolicy;
use App\Policies\UPCPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		UPCalculator::class => UPCPolicy::class,
		Tariffs::class => TariffsPolicy::class,
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();
	}
}

