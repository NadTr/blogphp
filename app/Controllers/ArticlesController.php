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
			VALUES(:title, :text, :author, NOW())
		 	RETURNING id');

		$prep->bindValue('title', $title,  \PDO::PARAM_STR);
		$prep->bindValue('text', $Atext,  \PDO::PARAM_STR);
		$prep->bindValue('author', $author,  \PDO::PARAM_STR);
	 	$prep->execute();
		$result = $prep->fetch(\PDO::FETCH_ASSOC);

		$categories = $request->getParsedBody()['categories'];
		$idarticle = $result['id'];
			foreach ($categories as $key => $value) {
			
				$prep = $this->container->db->prepare('
					INSERT INTO categoriesarticles(categorie, article)
					VALUES(:categorie, :article )');

				$prep->bindValue('categorie', $value,  \PDO::PARAM_STR);
				$prep->bindValue('article', $idarticle,  \PDO::PARAM_STR);

				$prep->execute();
		}

		$args['articles'] = $prep;
		$args['categories'] = $prep;

		return $response->withRedirect($this->container->router->pathFor('home'),301);

	}

	
	public function edit(Request $request, Response $response,array $args){

		$id = $args['id']; //checks _GET [IS PSR-7 compliant]
		$prep = $this->container->db->prepare('
			SELECT * FROM articles WHERE id =:id');
		
		$prep->bindParam("id", $id);
		$prep->execute();
		$article=$prep->fetch();
		

		$prep = $this->container->db->prepare('
			
			SELECT categorie 
			FROM categoriesarticles
			Where article=:id
			');
		$prep->bindParam("id", $id);
		$prep->execute();
		$catarticles= $prep->fetch();


		$prep = $this->container->db->prepare('
			
			SELECT * from categories');
		

		$prep->execute();
		$categories = $prep->fetchAll();
		

		$args['categories']=$categories;
		$args['article'] = $article;
		$args['catarticles'] = $catarticles;
		
		$this->render($response,'pages/articleEdit.twig', $args);
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

		return $response->withRedirect($this->container->router->pathFor('home'),301);

	}

}
