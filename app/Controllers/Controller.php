<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class Controller {

	protected $container;
	
	public function __construct($container)
	{
		$this->container = $container;
		
	}
	
	public function render($response, $file, $args){
		$this->container->view->render($response, $file, $args);
	}
}