<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
	//display articles
$app->get("/", \App\Controllers\PagesController::class . ":home");

	//add article
$app->post('/add', \App\Controllers\ArticlesController::class . ":add")->setName('add');
	// delete 
$app->delete('/del/{id}', \App\Controllers\ArticlesController::class . ":del")->setName('del');

	//display edit
$app->get("/article/edit/{id}", \App\Controllers\ArticlesController::class . ":edit")->setName('edit');
	// update 
$app->put('/article/{id}', \App\Controllers\ArticlesController::class . ":upd")->setName('update');
