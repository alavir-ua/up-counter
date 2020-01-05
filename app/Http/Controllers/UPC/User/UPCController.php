<?php

namespace App\Http\Controllers\UPC\User;

use App\Http\Requests\UPCreateRequest;
use App\Models\UPCalculator;
use App\Repositories\UPCRepository;
use App\Repositories\TariffsRepository;

class UPCController extends BaseController
{

	private $UPCRepository;
	private $TariffsRepository;

	public function __construct()
	{
		parent::__construct();
//		Инициализация репозиториев
		$this->UPCRepository = app(UPCRepository::class);
		$this->TariffsRepository = app(TariffsRepository::class);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function index()
	{
		//Получение аутенцифицированого юзера
		$user = \Auth::user();
		$id = \Auth::id();
//		Выборка по методу репозитория
		$paginator = $this->UPCRepository->getAllWithPaginate();

		//Подключение вида с передачей в него переменных(коллекций)
		return view('upc.calculations.index', compact('paginator', 'user', 'id'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
//		Получение аутенцифицированого юзера
		$user = \Auth::user();
//		Получаем екземпляр cоздаваемой записи
		$uPCalculator = new UPCalculator();

//		Проверяемправа юзера на создание записи согласно политики
		if ($user->can('create', $uPCalculator)) {

//		Создание экземпляра обьекта модели
			$item = new UPCalculator();

//		Выборка по методу репозитория последней записи тарифов
			$tariff = $this->TariffsRepository->getLastUpdateRecord();

//		Если последняя запись тарифов есть редирект на создание расчета
			if ($tariff) {
				return view('upc.calculations.create', compact('item', 'tariff'));

//		Если ни одной записи тарифов нет редирект на создание тарифа
			} else {
				return redirect()->route('upc.user.tariffs.create');
			}
		} else {
			return back()
				->withErrors(['msg' => "Ви не маєте права створювати цей запис"]);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(UPCreateRequest $request)
	{
//		Получение данных с формы через экземпляр UPCreateRequest с валидацией
		$data = $request->all();
//		Создание экземпляра модели и наполнение ее данными
		$item = (new UPCalculator())->create($data);

//		Если успешно то редирект на индекс с оповещением, иначе возврат к форме с выводом ошибки
		if ($item) {
			return redirect()->route('upc.user.calculation.index', [$item->id])
				->with(['success' => "Запис створено успішно"]);
		} else {
			return back()
				->withErrors(['msg' => "Помилка створення"])
				->withInput();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
//		Получение аутенцифицированого юзера
		$user = \Auth::user();
//		Получаем екземпляр удаляемой записи
		$uPCalculator = UPCalculator::find($id);

//		Проверяем права юзера на удаление записи согласно политики
		if ($user->can('delete', $uPCalculator)) {
//		Полное удаление из БД forceDelete()
			$result = UPCalculator::find($id)->forceDelete();

//		Если успешно то редирект на индекс с оповещением, иначе возврат на индекс с выводом ошибки
			if ($result) {
				return redirect()
					->route('upc.user.calculation.index')
					->with(['success' => "Запис видалено успішно"]);
			} else {
				return back()
					->withErrors(['msg' => "Помилка видалення"]);
			}
//		Если прав у юзера нет, возврат на индекс с выводом ошибки
		} else {
			return back()
				->withErrors(['msg' => "Ви не маєте права видаляти цей запис"]);
		}
	}
}