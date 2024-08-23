<?php

declare(strict_types=1);

use App\Router;
use Controller\AdController;
use Controller\BranchController;
use Controller\UserController;

Router::get('/', fn()=> loadController('home'));

Router::get('/ads/{id}', function (int $id) {
//    loadController('showAd', ['id'=>$id]);
    (new AdController())->show($id);
});

//dd($_SERVER['REQUEST_URI']);
Router::get('/ads/create', fn()=> loadController('createAdG'));
Router::post('/ads/create',  fn()=> (new AdController())->create());

Router::get('/status', fn()=> loadController('showStatus'));
Router::get('/status/create', fn()=> loadView('dashboard/create-status'));
Router::post('/status/create', fn()=> loadController('createStatus'));

Router::get('/branch', fn()=> (new BranchController())->index());
Router::get('/branch/create', fn()=> loadView('dashboard/create-branch'));
Router::post('/branch/create', fn()=> (new BranchController())->create());

Router::get('/login', fn()=> loadController('login'));
Router::post('/login', fn()=> (new UserController())->login());
Router::get('/signup', fn()=> loadController('signup'));
Router::post('/signup', fn()=> (new UserController())->create());

Router::get('/forget/password', fn()=> loadController('forgetPassword'));

Router::errorResponse(404, 'Not Found');