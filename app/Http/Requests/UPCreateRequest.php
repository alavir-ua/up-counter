<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UPCreateRequest extends FormRequest
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
//		Правила валидации формы создания расчета
		return [
			'electricity' => 'required|numeric|between:0.00,999.99',
			'gaz' => 'required|numeric|between:0.00,99.99',
			'water' => 'required|numeric|between:0.00,99.99',
			'heat' => 'required|numeric|between:0.00,9999.99',
			'utilities' => 'required|numeric|between:0.00,999.99',
			'intercom' => 'required|numeric||between:0.00,99.99'
		];
	}

	public function messages()
	{
//		Правила преобразования стандартных сообщений ошибок в понятные для юзера
		return [
			'electricity.required' => 'Введіть значення поля \'електрика\'',
			'gaz.required' => 'Введіть значення поля \'газ\'',
			'water.required' => 'Введіть значення поля \'вода\'',
			'heat.required' => 'Введіть значення поля \'опалення\'',
			'utilities.required' => 'Введіть значення поля \'компослуги\'',
			'intercom.required' => 'Введіть значення поля \'домофон\'',

			'electricity.numeric' => 'Значення поля \'електрика\' має бути числовим',
			'gaz.numeric' => 'Значення поля \'газ\' має бути числовим',
			'water.numeric' => 'Значення поля \'вода\' має бути числовим',
			'heat.numeric' => 'Значення поля \'опалення\' має бути числовим',
			'utilities.numeric' => 'Значення поля \'компослуги\' має бути числовим',
			'intercom.numeric' => 'Значення поля \'домофон\' має бути числовим',

			'electricity.between' => 'Значення поля \'електрика\' має бути у межах:0.00,999.99',
			'gaz.between' => 'Значення поля \'газ\' має бути у межах:0.00,99.99',
			'water.between' => 'Значення поля \'вода\' має бути у межах:0.00,99.99',
			'heat.between' => 'Значення поля \'опалення\' має бути у межах:0.00,9999.99',
			'utilities.between' => 'Значення поля \'компослуги\' має бути у межах:0.00,999.99',
			'intercom.between' => 'Значення поля \'домофон\' має бути у межах:0.00,99.99',
		];
	}
}
