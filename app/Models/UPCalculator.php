<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UPCalculator extends Model
{
  //Разрешена запись меток времени created_at и updated_at
	public $timestamps = true;

  //Определeние для каких атрибутов разрешить массовое назначение.
	protected $fillable
		= [
			'electricity',
			'gaz',
			'water',
			'heat',
			'intercom',
			'utilities',
			'total',
		];

	public function user()
	{
		//Расчет за месяц принадлежит пользователю
		return $this->belongsTo(User::class);
	}
}
