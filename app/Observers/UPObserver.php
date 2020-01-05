<?php

namespace App\Observers;

use App\Models\UPCalculator;
use App\Repositories\TariffsRepository;

class UPObserver
{
    //Действия перед созданием экземпляра модели
	public function creating(UPCalculator $uPCalculator)
	{
//		Установка значения поля user_id
		$this->setUserId($uPCalculator);

//		Установка значения поля electricity
		$this->setElectricity($uPCalculator);

//		Установка значения поля gaz
		$this->setGaz($uPCalculator);

//		Установка значения поля water
		$this->setWater($uPCalculator);

//		Установка значения поля heat
		$this->setHeat($uPCalculator);

//		Установка значения поля utilities
		$this->setUtilities($uPCalculator);

//		Установка значения поля intercom
		$this->setIntercom($uPCalculator);

//		Установка значения поля total
		$this->setTotal($uPCalculator);
	}

//	Получение записи последнего тарифа
	protected function getLastTariff()
	{
		return $tariff = (new TariffsRepository())->getLastUpdateRecord();
	}

// Присвоение id аунтефицированого пользователя полю user_id
	protected function setUserId(UPCalculator $uPCalculator)
	{
		$uPCalculator->user_id = \Auth::id();
	}

//	Расчет стоимости электричества
	protected function countElectricity(UPCalculator $uPCalculator)
	{
		if ($uPCalculator->electricity <= 100) {
			return round(floatval($uPCalculator->electricity) * self::getLastTariff()->elect_before,
				1);
		} else {
			return round((floatval($uPCalculator->electricity) - 100) * self::getLastTariff()->elect_under + 100 *
				self::getLastTariff()->elect_before, 1);
		}
	}

//	Преобразование записи в модель к типу кВт/стоимость
	protected function setElectricity(UPCalculator $uPCalculator)
	{
		$uPCalculator->electricity = $uPCalculator->electricity . '/' . $this->countElectricity($uPCalculator);
	}

//	Расчет стоимости газа
	protected function countGaz(UPCalculator $uPCalculator)
	{
		return round(floatval($uPCalculator->gaz) * self::getLastTariff()->gaz_t, 1);
	}

//	Преобразование записи в модель к типу м.куб/стоимость
	protected function setGaz(UPCalculator $uPCalculator)
	{
		$uPCalculator->gaz = $uPCalculator->gaz . '/' . $this->countGaz($uPCalculator);
	}

//	Расчет стоимости воды
	protected function countWater(UPCalculator $uPCalculator)
	{
		return round(floatval($uPCalculator->water) * self::getLastTariff()->water_t, 1);
	}

//	Преобразование записи в модель к типу м.куб/стоимость
	protected function setWater(UPCalculator $uPCalculator)
	{
		$uPCalculator->water = $uPCalculator->water . '/' . $this->countWater($uPCalculator);
	}

//	Округление показаний тепла с формы до одного знака после запятой
	protected function setHeat(UPCalculator $uPCalculator)
	{
		return $uPCalculator->heat = round($uPCalculator->heat, 1);
	}

//	Округление показаний комунальных с формы до одного знака после запятой
	protected function setUtilities(UPCalculator $uPCalculator)
	{
		return $uPCalculator->utilities = round($uPCalculator->utilities, 1);
	}

//	Округление показаний домофона с формы до одного знака после запятой
	protected function setIntercom(UPCalculator $uPCalculator)
	{
		return $uPCalculator->intercom = round($uPCalculator->intercom, 1);
	}

//	Расчет cумарной стоимости коммунальных
	protected function countTotal(UPCalculator $uPCalculator)
	{
		return $uPCalculator->total =
			$this->countElectricity($uPCalculator)
			+ $this->countGaz($uPCalculator)
			+ $this->countWater($uPCalculator)
			+ $this->setHeat($uPCalculator)
			+ $this->setUtilities($uPCalculator)
			+ $this->setIntercom($uPCalculator);
	}

//	Округление показаний  cуммарной стоимости до одного знака после запятой
	protected function setTotal(UPCalculator $uPCalculator)
	{
		$uPCalculator->total = round(floatval(($this->countTotal($uPCalculator))));
	}
}
