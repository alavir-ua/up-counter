<?php

namespace App\Http\Controllers\UPC\User;

use App\Http\Controllers\UPC\BaseController as GuestBaseController;

abstract class BaseController extends GuestBaseController
{
	public function __construct()
	{
//		Доступ к наследуемым классам только через аутентификацию и подтв. email
		$this->middleware(['auth','verified']);
//		$this->middleware('auth');
	}
}
