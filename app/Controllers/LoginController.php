<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use \PDO;

class LoginController extends Controller {

	public function login(Request $request, Response $response, array $args){
    return $this->render($response, 'pages/login.twig', $args);

  }

    public function log(Request $request, Response $response, array $args) {
      $pseudo = $request->getParsedBody()['pseudo'];
      $password = $request->getParsedBody()['password'];
      $hashedpass= password_hash($password, PASSWORD_BCRYPT);
      return $response->withRedirect('/', 301);
    }


}
