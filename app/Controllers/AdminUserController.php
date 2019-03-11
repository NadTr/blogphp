<?php


namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class AdminUserController extends Controller {

	public function adminuser(Request $request, Response $response){

		$users = $this->container->db->query('
			SELECT
								
				users.firstname as firstname, 
				users.lastname as lastname, 
				users.username as username, 
				users.permission as permission, 
				users.email as email,
				users.id as id
				
			FROM users ')->fetchAll();
		
		$args['users'] = $users;

		$this->render($response,'admin/UsersAdmin.twig', $args);
	}

	public function usersedit(Request $request, Response $response,$args){

		$id = $args['id'];
		$prep = $this->container->db->prepare('
			SELECT * FROM users WHERE id =:id');
		$prep->bindParam("id", $id);
	
		$prep->execute();
		$res=$prep->fetch();

		$this->render($response,'admin/UserEditAdmin.twig', $res);
	}

		public function usersupd(Request $request, Response $response, $args){

		$id = $args['id']; //checks _GET [IS PSR-7 compliant]
		$username = $request->getParsedBody()['username']; //checks _POST [IS PSR-7 compliant]
		$lastname = $request->getParsedBody()['lastname']; //checks _POST [IS PSR-7 compliant]
		$firstname = $request->getParsedBody()['firstname']; //checks _POST [IS PSR-7 compliant]
		$permission = $request->getParsedBody()['permission']; //checks _POST [IS PSR-7 compliant]
		$email = $request->getParsedBody()['email']; //checks _POST [IS PSR-7 compliant]

		$prep = $this->container->db->prepare('
			UPDATE users set username=:username, lastname=:lastname , firstname=:firstname, permission=:permission, email=:email where id=:id');

		$prep->bindParam("id", $id);
		$prep->bindValue('username', $username,  \PDO::PARAM_STR);
		$prep->bindValue('lastname', $lastname,  \PDO::PARAM_STR);
		$prep->bindParam('firstname', $firstname,  \PDO::PARAM_STR);
		$prep->bindParam('permission', $permission,  \PDO::PARAM_STR);
		$prep->bindParam('email', $email,  \PDO::PARAM_STR);
		$prep->execute();

		$args['user'] = $prep;

		return $response->withRedirect($this->container->router->pathFor('adminUsers'),301);

	}

}





 