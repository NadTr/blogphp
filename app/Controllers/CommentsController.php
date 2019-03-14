<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class CommentsController extends Controller {

	public function addCom (Request $request, Response $response){
		$title = $request->getParsedBody()['title']; //checks _POST [IS PSR-7 compliant]
		$Ctext = $request->getParsedBody()['text']; //checks _POST [IS PSR-7 compliant]
		$article = $request->getParsedBody()['art']; //checks _GET [IS PSR-7 compliant]
		$commentator = $_SESSION['id'];

		


		$prep = $this->container->db->prepare('
			INSERT INTO comments(title, text, commentator, date, article) 
			VALUES(:title, :text, :commentator, NOW(), :article)');

		$prep->bindValue('title', $title,  \PDO::PARAM_STR);
		$prep->bindValue('text', $Ctext,  \PDO::PARAM_STR);
		$prep->bindValue('commentator', $commentator,  \PDO::PARAM_STR);
		$prep->bindValue('article', $article,  \PDO::PARAM_STR);
	
		$prep->execute();

		$args['comments'] = $prep;

		return $response->withRedirect($this->container->router->pathFor('home'),301);
	}
	public function upCom(Request $request, Response $response, $args){

		$id = $args['id']; //checks _GET [IS PSR-7 compliant]
		$title = $request->getParsedBody()['title']; //checks _POST [IS PSR-7 compliant]
		$Ctext = $request->getParsedBody()['text']; //checks _POST [IS PSR-7 compliant]
		$date = $request->getParsedBody()['date']; //checks _POST [IS PSR-7 compliant]

		$prep = $this->container->db->prepare('
			UPDATE comments set title=:title, text=:text , date=:date where id=:id');

		$prep->bindParam("id", $id);
		$prep->bindValue('title', $title,  \PDO::PARAM_STR);
		$prep->bindValue('text', $Ctext,  \PDO::PARAM_STR);
		$prep->bindParam('date', $date,  \PDO::PARAM_STR);
		$prep->execute();

		$args['comments'] = $prep;

		return $response->withRedirect($this->container->router->pathFor('home'),301);

	}
	public function editCom(Request $request, Response $response,$args){

		$id = $args['id'];
		$prep = $this->container->db->prepare('
			SELECT * FROM comments WHERE id =:id');
		$prep->bindParam("id", $id);
	
		$prep->execute();
		$res=$prep->fetch();

		$this->render($response,'pages/commentEdit.twig', $res);
	}
	public function delCom(Request $request, Response $response, $args){
		$id = $args['id']; //checks _GET [IS PSR-7 compliant]
		$prep = $this->container->db->prepare('
			DELETE FROM comments where id=:id');
		$prep->bindParam("id", $id);
		$prep->execute();
		$args['comments']= $prep;
		return $response->withRedirect($this->container->router->pathFor('home'),301);
	}
	

}