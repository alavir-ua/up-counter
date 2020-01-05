<?php

namespace App\Repositories;

use App\Models\UPCalculator as Model;
use Illuminate\Support\Facades\Auth;

class UPCRepository extends CoreRepository
{

	protected function getModelClass()
	{
		return Model::class;
	}

//	Метод выбора данных с модели для пагинации(index)
	public function getAllWithPaginate()
	{
		$columns = [
			'id',
			'user_id',
			'electricity',
			'gaz',
			'water',
			'heat',
			'intercom',
			'utilities',
			'total',
			'created_at',
			'updated_at',
		];
		$result = $this
			->startConditions()
			->select($columns)//выбор заданных полей
			->where('user_id', Auth::id())//условие выбора полей по значению user_id
			->with([
				'user:id,name', //выбор поля name таблицы users по внешнему ключу
			])
			->orderBy('created_at', 'DESC')//сортировка записей по убыванию (created_at)
			->paginate(5); //количество записей для пагинации

		return $result;
	}

	public function getAllData()
	{
		return \DB::table('u_p_calculators')
			->select('electricity',
				'gaz',
				'water',
				'heat',
				'total',
				'created_at',)
			->where('user_id', Auth::id())
			->orderBy('created_at', 'ASC')
			->get();
	}

	public function getDataOfUser()
	{
		return \DB::table('u_p_calculators')
			->select('electricity',
				'gaz',
				'water',
				'heat',
				'total',
				'created_at',)
			->where('user_id', Auth::id())
			->orderBy('created_at', 'ASC')
			->get();
	}
}