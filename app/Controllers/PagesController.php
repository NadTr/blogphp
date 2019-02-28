<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;



class PagesController extends Controller {

	public function home(Request $request, Response $response){

		$result = $this->container->db->query('SELECT articles.id, title, text, date, username FROM articles INNER JOIN users on articles.author=users.id')->fetchAll();
		$args['result'] = $result;

		$this->render($response,'pages/home.twig', $args);
	}

}
