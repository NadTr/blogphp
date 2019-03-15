<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use \PDO;



class ProfileController extends Controller {

	public function diplayProfile(Request $request, Response $response, array $res){
		$id = $_SESSION['id'];
		$stmt = $this->container->db->prepare('SELECT firstname, lastname, username, email FROM users WHERE id =:id');
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$res=$stmt->fetch();
		$this->render($response,'pages/profile.twig', $res);
	}

	public function editprofile(Request $request, Response $response){
		$id = $_SESSION['id'];
		$stmt = $this->container->db->prepare('SELECT firstname, lastname, username, email FROM users WHERE id =:id');
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$res=$stmt->fetch();
		$this->render($response,'pages/editprofile.twig', $res);
	}

	public function submitchanges(Request $request, Response $response, array $args){

		$id = $_SESSION['id'];
		$firstname = $request->getParsedBody()['firstname'];
		$lastname = $request->getParsedBody()['lastname'];
		$username = $request->getParsedBody()['username'];
		$email = $request->getParsedBody()['email'];

		$stmt = $this->container->db->prepare("UPDATE users SET firstname=:firstname, lastname=:lastname, username=:username, email=:email where id=:id");
		$stmt->bindValue('firstname', $firstname, PDO::PARAM_STR);
		$stmt->bindValue('lastname', $lastname, PDO::PARAM_STR);
		$stmt->bindValue('username', $username, PDO::PARAM_STR);
		$stmt->bindValue('email', $email, PDO::PARAM_STR);
		$stmt->bindValue('id', $id, PDO::PARAM_STR);
		$stmt->execute();
		return $response->withRedirect('/profile',301);

	}

}
