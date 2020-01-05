<?php

namespace App\Http\Controllers\UPC\User;

use App\Repositories\UPCRepository;

class ChartController extends BaseController
{
	private $UPCRepository;
	public $randHexColor;

	public function __construct()
	{
		parent::__construct();
//		Инициализация репозиториев
		$this->UPCRepository = app(UPCRepository::class);
	}

//	Функция генерации случайного цвета HEX
	public function randomHex()
	{
		$chars = 'ABCDEF0123456789';
		$color = '#';
		for ($i = 0; $i < 6; $i++) {
			$color .= $chars[rand(0, strlen($chars) - 1)];
		}
		return $color;
	}
//	Функция генерации случайного цвета rgba
	public function randomRgba($opacity)
	{
		$rgbColor = array();

		foreach (array('r', 'g', 'b') as $color) {
			$rgbColor[$color] = mt_rand(0, 255);
		}
		return 'rgba(' . implode(",", $rgbColor) . ',' . $opacity . ')';
	}

//	Функция получения коллекции данных аутен. пользователя
	public function getUpcData()
	{
		return $this->UPCRepository->getAllData();
	}

//	Функция получения массива дат из коллекции
	public function getDates()
	{
		$dates = array_column($this->getUpcData()->toArray(), 'created_at');
		foreach ($dates as &$value) {
			$timestamp = strtotime($value);
			$value = (date('m', $timestamp) - 1);
			switch ($value) {
				case 0:
					$value = 'Грудень';
					break;
				case 1:
					$value = 'Січень';
					break;
				case 2:
					$value = 'Лютий';
					break;
				case 3:
					$value = 'Березень';
					break;
				case 4:
					$value = 'Квітень';
					break;
				case 5:
					$value = 'Травень';
					break;
				case 6:
					$value = 'Червень';
					break;
				case 7:
					$value = 'Липень';
					break;
				case 8:
					$value = 'Серпень';
					break;
				case 9:
					$value = 'Вересень';
					break;
				case 10:
					$value = 'Жовтень';
					break;
				case 11:
					$value = 'Листопад';
					break;
			}
			if ($value == 'Грудень') {
				$value = $value . '/' . (date('Y', $timestamp) - 1);
			} else {
				$value = $value . '/' . date('Y', $timestamp);
			}
		}
		return $dates;
	}

//	Функции возвращения данных для графиков

	public function getDataChartTotal()
	{
		$total = array_column($this->getUpcData()->toArray(), 'total');
		return [
			'labels' => $this->getDates(),
			'datasets' => array([
				'label' => 'Вартість/Грн',
				'backgroundColor' => $this->randomRgba(0.8),
				'borderColor' => '#ffffff',
				'borderWidth' => 1,
				'data' => $total,
			])
		];
	}

	public function getDataChartElect()
	{
		$elect = array_column($this->getUpcData()->toArray(), 'electricity');
		foreach ($elect as &$value) {
			$value = explode('/', $value);
		}

		$cost = array_column($elect, '1');
		$kwatt = array_column($elect, '0');

		return [
			'labels' => $this->getDates(),
			'datasets' => array(
				[
					'label' => 'Грн',
					'backgroundColor' => $this->randomRgba(0.8),
					'data' => $cost,
				],
				[
					'label' => 'Електрика/кВт',
					'backgroundColor' => $this->randomRgba(0.8),
					'data' => $kwatt,
				])
		];
	}

	public function getDataChartWater()
	{
		$water = array_column($this->getUpcData()->toArray(), 'water');
		foreach ($water as &$value) {
			$value = explode('/', $value);
		}

		$cost = array_column($water, '1');
		$capacity = array_column($water, '0');

		return [
			'labels' => $this->getDates(),
			'datasets' => array(
				[
					'label' => 'Грн',
					'backgroundColor' => $this->randomRgba(0.8),
					'data' => $cost,
				],
				[
					'label' => 'Вода/м³',
					'backgroundColor' => $this->randomRgba(0.8),
					'data' => $capacity,
				])
		];
	}

	public function getDataChartGaz()
	{
		$gaz = array_column($this->getUpcData()->toArray(), 'water');
		foreach ($gaz as &$value) {
			$value = explode('/', $value);
		}

		$cost = array_column($gaz, '1');
		$capacity = array_column($gaz, '0');

		return [
			'labels' => $this->getDates(),
			'datasets' => array(
				[
					'label' => 'Грн',
					'backgroundColor' => $this->randomRgba(0.8),
					'data' => $cost,
				],
				[
					'label' => 'Газ/м³',
					'backgroundColor' => $this->randomRgba(0.8),
					'data' => $capacity,
				])
		];
	}

	public function getDataChartHeat()
	{
		$heat = array_column($this->getUpcData()->toArray(), 'heat');
		return [
			'labels' => $this->getDates(),
			'datasets' => array([
				'label' => 'Опалення/Грн',
				'backgroundColor' => $this->randomRgba(0.8),
				'borderColor' => '#ffffff',
				'borderWidth' => 1,
				'data' => $heat,
			])
		];
	}

	public function index()
	{
		return view('upc.chart');
	}
}
