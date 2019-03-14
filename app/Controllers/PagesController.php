<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class PagesController extends Controller {

	public function home(Request $request, Response $response, array $args){

		$articles = $this->container->db->query('
			SELECT
				articles.title as title,
				articles.id as id,
				articles.date as date,
				articles.text as text,
				users.username as author,
				users.id as authorid
				
			FROM articles
			INNER JOIN users on articles.author=users.id')->fetchAll();

		$categories = $this->container->db->query('
			SELECT article as article_id, name
			FROM categoriesarticles
			INNER JOIN categories on categorie = categories.id')->fetchAll();

		

		foreach ($articles as &$article) {
			# crée une boite vide pour y mettre les categories de mes articles 
			$article['categories'] = array();
		}

		#pour chaque catégorie, on verifie sir l'id de l'article est le meme et on le joint
		#& pour ne pas travailler sur une copie de l'article
		foreach ($categories as $categorie) {
			foreach ($articles as &$article) {
				if($article['id'] === $categorie['article_id']){
					array_push($article['categories'], $categorie['name']);
				}
			}
		}

		$categoriesAll = $this->container->db->query('
			SELECT*
			FROM categories ')->fetchAll();
		

		$comments = $this->container->db->query('
			SELECT *
			FROM comments
			inner join articles on article=articles.id
			inner join users on commentator=users.id
			')->fetchAll();

		$args['articles'] = $articles;
		$args['comments'] = $comments;
		$args['categoriesAll']= $categoriesAll;
		
		$this->render($response,'pages/home.twig', $args);

	}

}
