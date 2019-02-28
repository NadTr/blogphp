<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;


class ArticlesController extends Controller {

	public function add(Request $request, Response $response){
	
		$title = $request->getParsedBody()['title']; //checks _POST [IS PSR-7 compliant]
		$Atext = $request->getParsedBody()['text']; //checks _POST [IS PSR-7 compliant]

		$prep = $this->container->db->prepare('INSERT INTO articles(title, text) VALUES(:title, :text)');
		
		$prep->bindValue('title', $title,  \PDO::PARAM_STR);
		$prep->bindValue('text', $Atext,  \PDO::PARAM_STR);


		$prep->execute();
		
		$args['result'] = $prep;
		
		return $response->withRedirect('/',301);

	}
	public function del(Request $request, Response $response, $args){
	
		$id = $args['id']; //checks _GET [IS PSR-7 compliant]
	
		$prep = $this->container->db->prepare('DELETE FROM articles where id=:id');
		
		$prep->bindParam("id", $id);
		$prep->execute();
		
		$args['result'] = $prep;
		
		return $response->withRedirect('/',301);

	}
	public function upd(Request $request, Response $response, $args){
	
		$id = $args['id']; //checks _GET [IS PSR-7 compliant]
		$title = $request->getParsedBody()['title']; //checks _POST [IS PSR-7 compliant]
		$Atext = $request->getParsedBody()['text']; //checks _POST [IS PSR-7 compliant]
		$date = $request->getParsedBody()['date']; //checks _POST [IS PSR-7 compliant]
		
		$prep = $this->container->db->prepare('UPDATE articles set title=:title, text=:text , date=:date where id=:id');
		
		$prep->bindParam("id", $id);
		$prep->bindValue('title', $title,  \PDO::PARAM_STR);
		$prep->bindValue('text', $Atext,  \PDO::PARAM_STR);
		$prep->bindParam('date', $date,  \PDO::PARAM_STR);
		$prep->execute();
		
		$args['result'] = $prep;
		
		return $response->withRedirect('/',301);

	}
	public function edit(Request $request, Response $response,$args){
		
		$id = $args['id'];
		$prep = $this->container->db->prepare('SELECT * FROM articles WHERE id =:id');
		$prep->bindParam("id", $id);
		
		$prep->execute();
		$res=$prep->fetch();

		$this->render($response,'pages/edit.twig', $res);
	}

}