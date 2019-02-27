<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use \PDO;

class RegisterController extends Controller {

	public function register(Request $request, Response $response, array $args){
    return $this->render($response, 'pages/register.twig', $args);

  }

    public function subreg(Request $request, Response $response, array $args) {
      $pseudo = $request->getParsedBody()['pseudo'];
      $email = $request->getParsedBody()['email'];
      $password = $request->getParsedBody()['password'];
      $hashedpass= password_hash($password, PASSWORD_BCRYPT);
      $admin='1';
      $stmt = $this->container->db->prepare("INSERT INTO users (pseudo, email, password, admin) VALUES (:pseudo, :email, :password, :admin)");
      $stmt->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
      $stmt->bindValue('email', $email, PDO::PARAM_STR);
      $stmt->bindValue('password', $hashedpass, PDO::PARAM_STR);
      $stmt->bindValue('admin', $admin, PDO::PARAM_STR);
      $stmt->execute();
      $args['result'] = $stmt;
      return $response->withRedirect('/', 301);
    }


}
