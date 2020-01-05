<?php

namespace App\Http\Controllers\UPC\User;

use App\Http\Requests\TariffsCreateRequest;
use App\Http\Requests\TariffsUpdateRequest;
use App\Models\Tariffs;
use App\Repositories\TariffsRepository;

class TariffsController extends BaseController
{
	private $TariffsRepository;

	public function __construct()
	{
		parent::__construct();
//		Инициализация репозиториев
		$this->TariffsRepository = app(TariffsRepository::class);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
//		Выборка по методу репозитория
		$paginator = $this->TariffsRepository->getAllWithPaginate();
//		Получение аутенцифицированого юзера для вывода name  в заголовке индекса
		$user = \Auth::user();
//		Подключение вида с передачей в него переменных(коллекций)
		return view('upc.tariffs.index', compact('paginator', 'user'));
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
//		Получаем екземпляр создаваемой записи
		$tariffs = new Tariffs();

//		Проверяем права юзера на создание записи согласно политики
		if ($user->can('create', $tariffs)) {

//		Создание экземпляра обьекта модели
			$item = new Tariffs();

//		Редирект на создание на форму создания тарифа
			return view('upc.tariffs.create', compact('item',));

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
	public function store(TariffsCreateRequest $request)
	{
//		Получение данных с формы через экземпляр TariffsCreateRequest с валидацией
		$data = $request->all();
//		Создание экземпляра модели и наполнение ее данными
		$item = (new Tariffs())->create($data);
//		Выборка по методу репозитория
		$paginator = $this->TariffsRepository->getAllWithPaginate();

//		Если создается первая запись тарифов, то редирект на создание расчета
		if ($paginator->count() != 1) {
//		Если успешно то редирект на индекс с оповещением, иначе возврат к форме с выводом ошибки
			if ($item) {
				return redirect()->route('upc.user.tariffs.index', [$item->id])
					->with(['success' => "Запис створено успішно"]);
			} else {
				return back()
					->withErrors(['msg' => "Помилка створення"])
					->withInput();
			}
		} else {
			if ($item) {
				return redirect()->route('upc.user.calculation.create')
					->with(['success' => "Запис створено успішно"]);
			} else {
				return back()
					->withErrors(['msg' => "Помилка створення"])
					->withInput();
			}
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//Получение аутенцифицированого юзера
		$user = \Auth::user();
		//Получаем екземпляр редактируемой записи
		$tariffs = Tariffs::find($id);

		//Проверяемправа юзера на редактирование записи согласно политики
		if ($user->can('update', $tariffs)) {

			$item = $this->TariffsRepository->getEdit($id);
			if (empty($item)) {
				abort(404);
			}
			return view('upc.tariffs.edit', compact('item'));

			//Если прав у юзера нет, возврат на индекс с выводом ошибки
		} else {
			return back()
				->withErrors(['msg' => "Ви не маєте права редагувати цей запис"]);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(TariffsUpdateRequest $request, $id)
	{
		$item = $this->TariffsRepository->getEdit($id);

		$data = $request->all();

		$result = $item->update($data);

		if ($result) {
			return redirect()
				->route('upc.user.tariffs.index', $item->id)
				->with(['success' => 'Запис оновлено успішно']);
		} else {
			return back()
				->withErrors(['msg' => "Помилка оновлення"])
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
//		Получаем екземпляр cоздаваемой записи
		$tariffs = Tariffs::find($id);

//		Проверяемправа юзера на создание записи согласно политики
		if ($user->can('delete', $tariffs)) {
//		Полное удаление из БД forceDelete()
			$result = Tariffs::find($id)->forceDelete();

//		Если успешно то редирект на индекс с оповещением, иначе возврат на индекс с выводом ошибки
			if ($result) {
				return redirect()
					->route('upc.user.tariffs.index')
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
