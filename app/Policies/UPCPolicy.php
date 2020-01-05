<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UPCalculator;
use Illuminate\Auth\Access\HandlesAuthorization;

class UPCPolicy
{
	use HandlesAuthorization;



	/**
	 * Determine whether the user can create u p calculators.
	 *
	 * @param  \App\Models\User $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->id > 0;
	}

	/**
	 * Determine whether the user can delete the u p calculator.
	 *
	 * @param  \App\Models\User $user
	 * @param  \App\Models\UPCalculator $uPCalculator
	 * @return mixed
	 */
	public function delete(User $user, UPCalculator $uPCalculator)
	{
		return $user->id == $uPCalculator->user_id;
	}
}
