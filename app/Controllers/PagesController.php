<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class PagesController extends Controller {

	public function home(Request $request, Response $response){
		
		$result = $this->container->db->query('SELECT * FROM article')->fetchAll();
		$args['result'] = $result;
		
		$this->render($response,'pages/home.twig', $args);
	}


	public function add(Request $request, Response $response){
	
		$title = $request->getParsedBody()['title']; //checks _POST [IS PSR-7 compliant]
		$Atext = $request->getParsedBody()['text']; //checks _POST [IS PSR-7 compliant]

		$prep = $this->container->db->prepare('INSERT INTO article(titre, texte) VALUES(:title, :Atext)');
		
		$prep->bindValue('title', $title,  \PDO::PARAM_STR);
		$prep->bindValue('Atext', $Atext,  \PDO::PARAM_STR);
		
		$prep->execute();
		
		$args['result'] = $prep;
		
		return $response->withRedirect('/',301);

	}
	public function del(Request $request, Response $response, $args){
	
		$id = $args['id']; //checks _GET [IS PSR-7 compliant]
	
		$prep = $this->container->db->prepare('DELETE FROM article where id=:id');
		
		$prep->bindParam("id", $id);
		$prep->execute();
		
		$args['result'] = $prep;
		
		return $response->withRedirect('/',301);

	}
	public function upd(Request $request, Response $response, $args){
	
		$id = $args['id']; //checks _GET [IS PSR-7 compliant]
		$title = $request->getParsedBody()['title']; //checks _POST [IS PSR-7 compliant]
		$Atext = $request->getParsedBody()['text']; //checks _POST [IS PSR-7 compliant]
		
		$prep = $this->container->db->prepare('UPDATE article set titre=:title, texte=:Atext');
		
		$prep->bindValue('title', $title,  \PDO::PARAM_STR);
		$prep->bindValue('Atext', $Atext,  \PDO::PARAM_STR);
		$prep->execute();
		
		$args['result'] = $prep;
		
		return $response->withRedirect('/',301);

	}
	public function edit(Request $request, Response $response,$args){
		
		$id = $args['id'];
		$result = $this->container->db->prepare('SELECT id,titre,texte FROM article WHERE id =:id');
		$result->bindParam("id", $id);
		
		$result->execute();
		$res=$result->fetch();

		$this->render($response,'pages/edit.twig', $res);
	}

}