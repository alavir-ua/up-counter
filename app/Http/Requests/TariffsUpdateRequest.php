<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TariffsUpdateRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
//		Проверка на аутентификацию
		return \Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
//		Правила валидации формы создания тарифа
		return [
			'elect_before' => 'required|numeric|between:0.00,9.99',
			'elect_under' => 'required|numeric|between:0.00,9.99',
			'gaz_t' => 'required|numeric|between:0.00,99.99',
			'water_t' => 'required|numeric|between:0.00,99.99',
		];
	}

	public function messages()
	{
//		Правила преобразования стандартных сообщений ошибок в понятные для юзера
		return [
			'elect_before.required' => 'Введіть значення поля \'електрика до 100\'',
			'elect_under.required' => 'Введіть значення поля \'електрика понад 100\'',
			'gaz_t.required' => 'Введіть значення поля \'газ\'',
			'water_t.required' => 'Введіть значення поля \'вода\'',

			'elect_before.numeric' => 'Значення поля \'електрика до 100 \' має бути числовим',
			'elect_under.numeric' => 'Значення поля \'електрика понад 100\' має бути числовим',
			'gaz_t.numeric' => 'Значення поля \'газ\' має бути числовим',
			'water_t.numeric' => 'Значення поля \'вода\' має бути числовим',

			'elect_before.between' => 'Значення поля \'електрика до 100\' має бути у межах:0.00,9.99',
			'elect_under.between' => 'Значення поля \'електрика понад 100\' має бути у межах:0.00,9.99',
			'gaz_t.between' => 'Значення поля \'газ\' має бути у межах:0.00,99.99',
			'water_t.between' => 'Значення поля \'вода\' має бути у межах:0.00,99.99',
		];
	}
}
