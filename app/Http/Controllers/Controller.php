<?php

/**
 * Base Controller
 *
 * This is the base controller class which is used to define common functionality
 * for all controllers. It includes authorization and validation traits.
 *
 * @package App\Http\Controllers
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
}//end class
