<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;



class PagesController extends Controller {

	public function home(Request $request, Response $response){
		
		$result = $this->container->db->query('SELECT * FROM articles')->fetchAll();
		$args['result'] = $result;
		
		$this->render($response,'pages/home.twig', $args);
	}

}