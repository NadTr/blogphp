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
			INNER JOIN users on articles.author=users.id
			ORDER BY date DESC
			LIMIT 5
			')->fetchAll();
		
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

		
		$comments = $this->container->db->query('
			SELECT
				comments.id as comid, 
				comments.title as comtitle, 
				comments.text as comtext, 
				comments.date as comdate, 
				users.id as commentator,
				users.username as username,
				article 
			FROM comments
			inner join articles on article=articles.id
			inner join users on commentator=users.id
			')->fetchAll();
		$args['articles'] = $articles;
		$args['comments'] = $comments;
		
		
		$this->render($response,'pages/home.twig', $args);
	}

	public function displaycat (Request $request, Response $response, array $args){

		$id = $args['id']; //checks _GET [IS PSR-7 compliant]
		$categories = $this->container->db->prepare('
			
			SELECT article, 
				   categorie, 
				   title as articletitle, 
				   text as articletext, 
				   date as articledate, 
				   author as authorid, 
				   username, 
				   name

			FROM categoriesarticles
			inner join articles on article = articles.id
			inner join users on author = users.id
			inner join categories on categorie = categories.id
			WHERE categorie=:id');

		$categories->bindParam("id", $id);
		$categories->execute();
		$res=$categories->fetchAll();
		
		$args['categories'] = $res;

		$this->render($response,'pages/categories.twig', $args);

	}

	public function displayauthor (Request $request, Response $response, array $args){

		$id = $args['id']; //checks _GET [IS PSR-7 compliant]
		$authors = $this->container->db->prepare('
			
			SELECT article, 
				   categorie, 
				   title as articletitle, 
				   text as articletext, 
				   date as articledate, 
				   author as authorid, 
				   username, 
				   name
			FROM categoriesarticles
			inner join articles on article = articles.id
			inner join users on author = users.id
			inner join categories on categorie = categories.id
			WHERE author=:id');

		$authors->bindParam("id", $id);
		$authors->execute();
		$res=$authors->fetchAll();
		
		$args['authors'] = $res;

		$this->render($response,'pages/authors.twig', $args);


	}


}
