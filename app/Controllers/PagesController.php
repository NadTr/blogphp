<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;



class PagesController extends Controller {

	public function home(Request $request, Response $response){
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
		$args['categoriesAll']= $categoriesAll;
		
		$this->render($response,'pages/home.twig', $args);

		/*$article = $this->container->db->query('
			SELECT 
			articles.id, 
			articles.title, 
			articles.text, 
			articles.date, 
			username as author 
			FROM articles 
			INNER JOIN users on articles.author=users.id')->fetchAll();
		$comment = $this->container->db->query('
			SELECT 
			comments.id, 
			comments.title, 
			comments.text, 
			comments.date, 
			username as commentator,
			articles.title as article 
			FROM comments 
			INNER JOIN users on comments.commentator=users.id
			INNER JOIN articles on comments.article=articles.id')->fetchAll();
		foreach ($articles as &$article) {
			# crée une boite vide pour y mettre les commentaires de mes articles 
			$article['comments'] = array();
		}
		#pour chaque commentaire, on verifie si l'id de l'article est le meme et on le joint
		#& pour ne pas travailler sur une copie de l'article
		foreach ($comments as $comment) {
			foreach ($articles as &$article) {
				if($article['id'] === $comment['article_id']){
					array_push($article['comments'], $comment['title']);
				}
			}
		}
		$args['articles'] = $article;

		$this->render($response,'pages/home.twig', $args);*/
	}

}
