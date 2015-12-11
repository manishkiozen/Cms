<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController {

	use DispatchesCommands;

}
