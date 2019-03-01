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
				users.email as email
				
			FROM users ')->fetchAll();
		
		$args['users'] = $users;

		$this->render($response,'admin/UsersAdmin.twig', $args);
	}


}





 