<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class AdminArticlesController extends Controller {

	public function articles(Request $request, Response $response){

		$articles = $this->container->db->query('
			SELECT
				articles.title as title,
				articles.id as id,
				articles.date as date,
				articles.text as text,
				users.username as author
				
			FROM articles
			INNER JOIN users on articles.author=users.id')->fetchAll();

		
		
		$args['articles'] = $articles;
		
		$this->render($response,'admin/ArticlesAdmin.twig', $args);
	}



	public function articlesdel(Request $request, Response $response, array $args){

		$id = $args['id']; //checks _GET [IS PSR-7 compliant]

		$prep = $this->container->db->prepare('
			DELETE FROM articles where id=:id');

		$prep->bindParam("id", $id);
		$prep->execute();

		$args['articles'] = $prep;

		return $response->withRedirect('/admin',301);

	}

	public function upd(Request $request, Response $response, array $args){

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

		return $response->withRedirect('admin');

	}
	public function edit(Request $request, Response $response,array $args){

		$id = $args['id'];
		$prep = $this->container->db->prepare('
			SELECT * FROM articles WHERE id =:id');
		$prep->bindParam("id", $id);
	
		$prep->execute();
		$res=$prep->fetch();

		$this->render($response,'admin/ArticleEdit.twig', $res);
	}




	

}





 
 