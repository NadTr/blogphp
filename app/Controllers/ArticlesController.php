<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;



class ArticlesController extends Controller {

	public function add(Request $request, Response $response){

		$title = $request->getParsedBody()['title']; //checks _POST [IS PSR-7 compliant]
		$Atext = $request->getParsedBody()['text']; //checks _POST [IS PSR-7 compliant]
		$author = $_SESSION['id'];
		


		$prep = $this->container->db->prepare('
			INSERT INTO articles(title, text, author, date) 
			VALUES(:title, :text, :author, NOW())');

		$prep->bindValue('title', $title,  \PDO::PARAM_STR);
		$prep->bindValue('text', $Atext,  \PDO::PARAM_STR);
		$prep->bindValue('author', $author,  \PDO::PARAM_STR);
		
	
		$prep->execute();

		$args['articles'] = $prep;

		return $response->withRedirect($this->container->router->pathFor('home'),301);

	}
	
	public function upd(Request $request, Response $response, $args){

		$id = $args['id']; //checks _GET [IS PSR-7 compliant]
		$title = $request->getParsedBody()['title']; //checks _POST [IS PSR-7 compliant]
		$Atext = $request->getParsedBody()['text']; //checks _POST [IS PSR-7 compliant]
		$date = $request->getParsedBody()['date']; //checks _POST [IS PSR-7 compliant]

		$prep = $this->container->db->prepare('
			UPDATE articles set title=:title, text=:text , date=:date where id=:id');

		$prep->bindParam("id", $id);
		$prep->bindValue('title', $title,  \PDO::PARAM_STR);
		$prep->bindValue('text', $Atext,  \PDO::PARAM_STR);
		$prep->bindParam('date', $date,  \PDO::PARAM_STR);
		$prep->execute();

		$args['articles'] = $prep;

		return $response->withRedirect($this->container->router->pathFor('home'),301);

	}
	public function edit(Request $request, Response $response,$args){

		$id = $args['id'];
		$prep = $this->container->db->prepare('
			SELECT * FROM articles WHERE id =:id');
		$prep->bindParam("id", $id);
	
		$prep->execute();
		$res=$prep->fetch();

		$this->render($response,'pages/articleEdit.twig', $res);
	}

}
