<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use \PDO;

class LoginController extends Controller {

	public function login(Request $request, Response $response, array $args){
		return $this->render($response, 'pages/login.twig', $args);

	}

	public function sublogin(Request $request, Response $response, array $args){

		if (isset($_POST['getusername'], $_POST['getpassword'])) {

			$username = $request->getParsedBody()['getusername'];
			$password = $request->getParsedBody()['getpassword'];
			$stmt = $this->container->db->prepare("SELECT id,pass, permission FROM users WHERE username = :username");
			$stmt ->bindParam('username', $username);
			$stmt->execute();
			$res=$stmt->fetch();

			if(password_verify($password,$res['pass'])){

				$_SESSION['username'] = $username;
				$_SESSION['permission']=$res['permission'];
				$_SESSION['id']=$res['id'];
			//	$args['alert']='You are connected'
				return $response->withRedirect('/', 301);
			}

			else{

				$res['alert'] = ['password or username is wrong'];
				return $this->render($response, 'pages/login.twig', $res);
			}
		}

		else{
			$res['alert'] = ['empty fields'];
			return $this->render($response, 'pages/login.twig', $res);
		}
	}


}
