<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tariffs;
use Illuminate\Auth\Access\HandlesAuthorization;

class TariffsPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can create tariffs.
	 *
	 * @param  \App\Models\User $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->id > 0;
	}


	/**
	 * Determine whether the user can delete the tariffs.
	 *
	 * @param  \App\Models\User $user
	 * @param  \App\Models\Tariffs $tariffs
	 * @return mixed
	 */
	public function delete(User $user, Tariffs $tariffs)
	{
		return $user->id == $tariffs->user_id;
	}

	/**
	 * Determine whether the user can update the tariffs.
	 *
	 * @param  \App\Models\User $user
	 * @param  \App\Models\Tariffs $tariffs
	 * @return mixed
	 */
	public function update(User $user, Tariffs $tariffs)
	{
		return $user->id == $tariffs->user_id;
	}

}
