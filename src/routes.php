<?php

use Slim\Http\Request;
use Slim\Http\Response;

// ROUTES
//articles

$app->get("/", \App\Controllers\PagesController::class . ":home")->setName('home');

	//add article
	$app->post('/add', \App\Controllers\ArticlesController::class . ":add")->setName('add');

	//display edit
	$app->get("/article/edit/{id}", \App\Controllers\ArticlesController::class . ":edit")->setName('edit');
	
	// update
	$app->put('/article/{id}', \App\Controllers\ArticlesController::class . ":upd")->setName('update');
	
	

//register
$app->get('/register', \App\Controllers\RegisterController::class . ":register" )->setName('register');
	$app->post('/submit/register', \App\Controllers\RegisterController::class . ":subreg" )->setName('subreg');

 	//Login
	$app->get('/login', \App\Controllers\LoginController::class . ":login" )->setName('login');
	$app->post('/submit/login', \App\Controllers\LoginController::class . ":sublogin" )->setName('sublogin');
	$app->get('/logout', \App\Controllers\LogoutController::class . ":logout" )->setName('logout');

	// profil
	$app->get('/profile', \App\Controllers\ProfileController::class . ":diplayProfile" )->setName('profile');
	$app->get('/editprofile', \App\Controllers\ProfileController::class . ":editProfile" )->setName('editprofile');
	$app->post('/submitchanges', \App\Controllers\ProfileController::class . ":submitchanges" )->setName('submitchanges');

	// comments
	$app->post('/addCom', \App\Controllers\CommentsController::class . ":addCom" )->setName('addCom');
	$app->get('/editCom/{id}', \App\Controllers\CommentsController::class . ":editCom" )->setName('editCom');
	$app->put('/upCom/{id}', \App\Controllers\CommentsController::class . ":upCom")->setName('upCom');
	$app->delete('/delCom/{id}', \App\Controllers\CommentsController::class . ":delCom")->setName('delCom');

//---------------------------------------------------------------------------------------------------
// ROUTES ADMIN
$app->get("/admin", \App\Controllers\AdminController::class . ":admin")->setName('adminHome');

// articles
$app->get("/admin/articles", \App\Controllers\AdminArticlesController::class . ":articles")->setName('articlesAdmin');
	
	// delete
	$app->delete('/admin/article/del/{id}', \App\Controllers\AdminArticlesController::class . ":articlesdel")->setName('articleAdminDel');
	
	//display edit
	$app->get("/admin/article/edit/{id}", \App\Controllers\AdminArticlesController::class . ":articlesedit")->setName('articleAdminEdit');
	
	// update
	$app->put('/admin/article/{id}', \App\Controllers\AdminArticlesController::class . ":articlesupd")->setName('articleAdminUpdate');

//catégories
$app->get("/admin/categories", \App\Controllers\AdminCategoriesController::class . ":admincat")->setName('categoriesAdmin');

	//add catégories
	$app->post('/admin/categories/add', \App\Controllers\AdminCategoriesController::class . ":adminaddcat")->setName('categoriesAdminAdd');

	// delete categorie
	$app->delete('/admin/categories/del/{id}', \App\Controllers\AdminCategoriesController::class . ":admincatdel")->setName('categoriesAdminDel');

// comments
$app->get("/admin/commentaires", \App\Controllers\AdminCommentairesController::class . ":admincommentaire")->setName('commentairesAdmin');

// delete comments
	$app->delete('/admin/commentaires/del/{id}', \App\Controllers\AdminCommentairesController::class . ":admincommentairesdel")->setName('commentairesAdminDel');

	

// users
$app->get("/admin/users", \App\Controllers\AdminUserController::class . ":adminuser")->setName('usersAdmin');

	// display edit
	$app->get('/admin/users/edit/{id}', \App\Controllers\AdminUserController::class . ":usersedit")->setName('userAdminEdit');
	
	// update
	$app->put('/admin/user/{id}', \App\Controllers\AdminUserController::class . ":usersupd")->setName('userAdminUpdate');
