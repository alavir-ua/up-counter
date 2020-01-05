<?php

namespace App\Http\Controllers\UPC\User;

use App\Models\User;

class UserController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function destroy($id)
	{
		if($id == \Auth::id()) {
			$result = User::find($id)->forceDelete();
			if ($result) {
				return redirect()
					->route('login')
					->with(['success' => "Акаунт та записи виделено успішно"]);
			} else {
				return back()
					->withErrors(['msg' => "Помилка видалення"]);
			}
		} else {
			return back()
				->withErrors(['msg' => "У Вас немає прав на видалення цього акаунту"]);
		}
	}
}

