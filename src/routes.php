<?php

use Slim\Http\Request;
use Slim\Http\Response;

// ROUTES
//articles
$app->get('/~evy/', \App\Controllers\PagesController::class . ":home");

	//add article
	$app->post('/~evy/' . 'add', \App\Controllers\ArticlesController::class . ":add")->setName('add');

	//display edit
	$app->get('/~evy/'.'article/edit/{id}', \App\Controllers\ArticlesController::class . ":edit")->setName('edit');
	// update
	$app->put('/~evy/' . 'article/{id}', \App\Controllers\ArticlesController::class . ":upd")->setName('update');

//register
$app->get('/~evy/' . 'register', \App\Controllers\RegisterController::class . ":register" )->setName('register');
	$app->post('/~evy/' . 'submit/register', \App\Controllers\RegisterController::class . ":subreg" );

 	//Login
	$app->get('/~evy/' . 'login', \App\Controllers\LoginController::class . ":login" )->setName('login');
	$app->post('/~evy/' . 'submit/login', \App\Controllers\LoginController::class . ":sublogin" );
	$app->get('/~evy/' . 'logout', \App\Controllers\LogoutController::class . ":logout" )->setName('logout');

	// profil
	$app->get('/~evy/' . 'profile', \App\Controllers\ProfileController::class . ":diplayProfile" )->setName('profile');
	$app->get('/~evy/' . 'editprofile', \App\Controllers\ProfileController::class . ":editProfile" )->setName('editprofile');
	$app->post('/~evy/' . 'submitchanges', \App\Controllers\ProfileController::class . ":submitchanges" )->setName('submitchanges');

//---------------------------------------------------------------------------------------------------
// ROUTES ADMIN
$app->get('/~evy/' . 'admin', \App\Controllers\AdminArticlesController::class . ":admin")->setName('admin');

// articles
	// delete
	$app->delete('/~evy/' . 'admin/del/{id}', \App\Controllers\AdminArticlesController::class . ":articlesdel")->setName('del');
	//display edit
	$app->get('/~evy/' . "admin/article/edit/{id}", \App\Controllers\AdminArticlesController::class . ":edit")->setName('AdminEdit');
	// update
	$app->put('/~evy/' . 'admin/article/{id}', \App\Controllers\AdminArticlesController::class . ":upd")->setName('update');
// users
$app->get('/~evy/' . "admin/users", \App\Controllers\AdminUserController::class . ":adminuser")->setName('adminUsers');
