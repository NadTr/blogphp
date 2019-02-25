<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
	//display articles
$app->get("/", \App\Controllers\PagesController::class . ":home");

	//add article
$app->post('/add', \App\Controllers\PagesController::class . ":add")->setName('add');
	// delete 
$app->delete('/del/{id}', \App\Controllers\PagesController::class . ":del")->setName('del');

	//display edit
$app->get("/article/edit/{id}", \App\Controllers\PagesController::class . ":edit")->setName('edit');
	// update 
$app->put('/article/{id}', \App\Controllers\PagesController::class . ":upd")->setName('update');
