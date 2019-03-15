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
	  $firstname = $request->getParsedBody()['firstname'];
	  $lastname = $request->getParsedBody()['lastname'];
	  $username = $request->getParsedBody()['username'];
	  $password = $request->getParsedBody()['password'];
		$repeatpassword = $request->getParsedBody()['repeatpassword'];
		if ($password == $repeatpassword){
			$hashedpass= password_hash($password, PASSWORD_BCRYPT);
		  $permission='3';    //1 Admin, 2 Auteur, 3 Utilisateur lambda
		  $stmt = $this->container->db->prepare("INSERT INTO users (firstname, lastname, username, pass, permission, email) VALUES (:firstname, :lastname, :username, :pass, :permission, :email)");
		  $stmt->bindValue('firstname', $firstname, PDO::PARAM_STR);
		  $stmt->bindValue('lastname', $lastname, PDO::PARAM_STR);
		  $stmt->bindValue('username', $username, PDO::PARAM_STR);
		  $stmt->bindValue('pass', $hashedpass, PDO::PARAM_STR);
		  $stmt->bindValue('permission', $permission, PDO::PARAM_STR);
		  $stmt->bindValue('email', $email, PDO::PARAM_STR);
		  $stmt->bindValue('pass', $hashedpass, PDO::PARAM_STR);
		  $res['result'] = $stmt->execute();
			$args['result'] = $res['result'];
			// $alert = array();
			// $alert['class'] = 'success'
			// $alert['message'] = 'You are well registered'
			// $args['alert'] = $alert;

		  return $response->withRedirect($this->container->router->pathFor('login'), 301);
		}
		else {
		  $args['alert'] = ['passwords don\'t match'];
			return $this->render($response, 'pages/register.twig', $args);
		}


  }
}
