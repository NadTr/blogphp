<?php

use Slim\Http\Request;
use Slim\Http\Response;

// ROUTES
//articles
$app->get("/", \App\Controllers\PagesController::class . ":home");

	//add article
	$app->post('/add', \App\Controllers\ArticlesController::class . ":add")->setName('add');

	//display edit
	$app->get("/article/edit/{id}", \App\Controllers\ArticlesController::class . ":edit")->setName('edit');
	// update
	$app->put('/article/{id}', \App\Controllers\ArticlesController::class . ":upd")->setName('update');

//register
$app->get('/register', \App\Controllers\RegisterController::class . ":register" )->setName('register');
	$app->post('/submit/register', \App\Controllers\RegisterController::class . ":subreg" );

 	//Login
	$app->get('/login', \App\Controllers\LoginController::class . ":login" )->setName('login');
	$app->post('/submit/login', \App\Controllers\LoginController::class . ":sublogin" );
	$app->get('/logout', \App\Controllers\LogoutController::class . ":logout" )->setName('logout');

	// profil
	$app->get('/profile', \App\Controllers\ProfileController::class . ":diplayProfile" )->setName('profile');
	$app->get('/editprofile', \App\Controllers\ProfileController::class . ":editProfile" )->setName('editprofile');
	$app->post('/submitchanges', \App\Controllers\ProfileController::class . ":submitchanges" )->setName('submitchanges');

//---------------------------------------------------------------------------------------------------
// ROUTES ADMIN
$app->get('/admin', \App\Controllers\AdminArticlesController::class . ":admin")->setName('admin');

// articles
	// delete
	$app->delete('/admin/del/{id}', \App\Controllers\AdminArticlesController::class . ":articlesdel")->setName('del');
	//display edit
	$app->get("/admin/article/edit/{id}", \App\Controllers\AdminArticlesController::class . ":edit")->setName('AdminEdit');
	// update
	$app->put('/admin/article/{id}', \App\Controllers\AdminArticlesController::class . ":upd")->setName('update');
// users
$app->get("/admin/users", \App\Controllers\AdminUserController::class . ":adminuser")->setName('adminUsers');
