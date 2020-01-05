<?php

namespace App\Observers;

use App\Models\Tariffs;

class TariffsObserver
{
	/**
	 * Handle the tariffs "created" event.
	 *
	 * @param  \App\Models\Tariffs $tariffs
	 * @return void
	 */
//	Действия перед созданием экземпляпа модели
	public function creating(Tariffs $tariffs)
	{
    	$this->setUserId($tariffs);
	}

//	Присвоение id аунтефицированого пользователя полю user_id
	protected function setUserId(Tariffs $tariffs)
	{
		$tariffs->user_id = \Auth::id();
	}
}
