<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariffs extends Model
{
	//Разрешена запись меток времени created_at и updated_at
	public $timestamps = true;

//	Определeние для каких атрибутов разрешить массовое назначение.
	protected $fillable
		= [
			'elect_before',
			'elect_under',
			'gaz_t',
			'water_t',
		];

	public function user()
	{
//		Расчет за месяц принадлежит пользователю
		return $this->belongsTo(User::class);
	}
}
