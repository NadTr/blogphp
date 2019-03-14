<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class AdminCommentairesController extends Controller {

	public function admincommentaire(Request $request, Response $response, array $args){

		$commentaires = $this->container->db->query('
			SELECT
				*			
			FROM comments ')->fetchAll();

		
		$args['comment']= $commentaires;

		$this->render($response,'admin/CommetairesAdmin.twig', $args);
	}

	public function admincommentairesdel(Request $request, Response $response, array $args){

		$id = $args['id']; //checks _GET [IS PSR-7 compliant]

		$prep = $this->container->db->prepare('
			DELETE FROM comments where id=:id');

		$prep->bindParam("id", $id);
		$prep->execute();

		$args['comment']= $commentaires;

		return $response->withRedirect($this->container->router->pathFor('commentairesAdmin'),301);

	}

}





 
 