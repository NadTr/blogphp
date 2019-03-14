<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;



class PagesController extends Controller {

	public function home(Request $request, Response $response){

		$article = $this->container->db->query('
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

		$this->render($response,'pages/home.twig', $args);
	}

}
