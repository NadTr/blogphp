<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use \PDO;

class LogoutController extends Controller {

	public function logout(Request $request, Response $response, array $args){
		 session_destroy();
		return $response->withRedirect('/', 301);
  }
}
