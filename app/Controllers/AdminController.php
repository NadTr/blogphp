<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class AdminController extends Controller {

	public function admin(Request $request, Response $response){

		$articles = $this->container->db->query('
			SELECT
				articles.title as title,
				articles.id as id,
				articles.date as date,
				articles.text as text,
				users.username as author
				
			FROM articles
			INNER JOIN users on articles.author=users.id')->fetchAll();

		$comments = $this->container->db->query('
			SELECT
				comments.title as title,
				comments.date as date
				
			FROM comments ')->fetchAll();

		$categories = $this->container->db->query('
			SELECT
				categories.name as categoriename 
				
			FROM categories ')->fetchAll();

		$users = $this->container->db->query('
			SELECT
								
				users.firstname as firstname, 
				users.lastname as lastname, 
				users.username as username, 
				users.permission as permission, 
				users.email as email
				
			FROM users ')->fetchAll();
		
		$args['articles'] = $articles;
		$args['comments'] = $comments;
		$args['categories']= $categories;
		$args['users'] = $users;

		$this->render($response,'admin/Admin.twig', $args);
	}

}





 
 