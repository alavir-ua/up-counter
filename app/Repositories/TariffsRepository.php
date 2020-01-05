<?php

namespace App\Repositories;

use App\Models\Tariffs as Model;
use Illuminate\Support\Facades\Auth;

class TariffsRepository extends CoreRepository
{

	protected function getModelClass()
	{
		return Model::class;
	}

//Метод выбора данных с модели для пагинации(index)
	public function getAllWithPaginate()
	{
		$columns = [
			'id',
			'user_id',
			'elect_before',
			'elect_under',
			'gaz_t',
			'water_t',
			'created_at',
			'updated_at',
		];
		$result = $this
			->startConditions()
			->select($columns) //выбор заданных полей
			->where('user_id', Auth::id()) //условие выбора полей по значению user_id
			->with([
				'user:id,name', //выбор поля name таблицы users по внешнему ключу
			])
			->orderBy('updated_at', 'DESC') //сортировка записей по убыванию (created_at)
			->paginate(5); //количество записей для пагинации

		return $result;
	}

//Метод выбора посдедней записи тарифов с модели для расчета и вывода в calculations.create
	public function getLastUpdateRecord()
	{
		$columns = [
			'id',
			'user_id',
			'elect_before',
			'elect_under',
			'gaz_t',
			'water_t',
			'created_at',
			'updated_at',
		];
		$result = $this
			->startConditions()
			->select($columns) //выбор заданных полей
			->where('user_id', Auth::id()) //условие выбора полей по значению user_id
			->with([
				'user:id,name', //выбор поля name таблицы users по внешнему ключу
			])
			->orderBy('updated_at', 'DESC')->first(); //сортировка (created_at) и выбор последней записи
		return $result;
	}

	public function getEdit($id)
	{
		return $this->startConditions()->find($id);
	}
}