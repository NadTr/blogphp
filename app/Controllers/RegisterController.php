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
		$firstname = $request->getParsedBody()['firstname'];
		$lastname = $request->getParsedBody()['lastname'];
		$username = $request->getParsedBody()['username'];
		$password = $request->getParsedBody()['password'];
		$repeatpassword = $request->getParsedBody()['repeatpassword'];
		$email = $request->getParsedBody()['email'];
      	$permission='3';    //1 Admin, 2 Auteur, 3 Utilisateur lambda

      	if($password != $repeatpassword){
      		
      		echo "Passwords do not match";
      	}
      	else {
      		$hashedpass= password_hash($password, PASSWORD_BCRYPT);
      		$stmt = $this->container->db->prepare("INSERT INTO users (firstname, lastname, username, pass, permission, email) VALUES (:firstname, :lastname, :username, :pass, :permission, :email)");
      		$stmt->bindValue('firstname', $firstname, PDO::PARAM_STR);
      		$stmt->bindValue('lastname', $lastname, PDO::PARAM_STR);
      		$stmt->bindValue('username', $username, PDO::PARAM_STR);
      		$stmt->bindValue('pass', $hashedpass, PDO::PARAM_STR);
      		$stmt->bindValue('permission', $permission, PDO::PARAM_STR);
      		$stmt->bindValue('email', $email, PDO::PARAM_STR);
      		$stmt->execute();
      		$args['result'] = $stmt;			        $data = mysql_query ($query)or die(mysql_error());
      		if($data)
      		{
			            //echo "Successfully registered";
      			echo '<script type="text/javascript">alert("Registration successful.");</script>';
      		}
      	}




      	return $response->withRedirect('/', 301);
      }


  }
