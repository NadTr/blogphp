<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class AdminCategoriesController extends Controller {

	public function admincat(Request $request, Response $response, array $args){

		$categories = $this->container->db->query('
			SELECT
				categories.name as categoriename,
				categories.id				
			FROM categories ')->fetchAll();

		
		$args['categories']= $categories;

		$this->render($response,'admin/CategoriesAdmin.twig', $args);
	}

	public function adminaddcat(Request $request, Response $response, array $args){

		$name = $request->getParsedBody()['name']; 
		
		$prep = $this->container->db->prepare('INSERT INTO categories(name)VALUES(:name)');
		
		$prep->bindValue('name', $name,  \PDO::PARAM_STR);
		
		$prep->execute();
		
		$args['categories']= $categories;
		
		return $response->withRedirect($this->container->router->pathFor('categoriesAdmin'),301);
		
	}
	public function admincatdel(Request $request, Response $response, array $args){

		$id = $args['id']; //checks _GET [IS PSR-7 compliant]

		$prep = $this->container->db->prepare('
			DELETE FROM categories where id=:id');

		$prep->bindParam("id", $id);
		$prep->execute();

		$args['categories']= $categories;

		return $response->withRedirect($this->container->router->pathFor('categoriesAdmin'),301);

	}

}





 
 