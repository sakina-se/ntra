<?php

declare(strict_types=1);

use App\Router;
use Controller\AdController;
use Controller\BranchController;
use Controller\UserController;

Router::get('/', fn()=> (new AdController())->home());

Router::get('/ads/{id}', fn(int $id) => (new AdController())->show($id));
Router::get('/ads/create', fn()=> loadController('createAdG'));
Router::post('/ads/create',  fn()=> (new AdController())->create());

Router::get('/ads/update/{id}', fn(int $id) => (new AdController())->edit($id));
Router::patch('/ads/update/{id}', fn(int $id) => (new AdController())->update($id));

Router::get('/status', fn()=> loadController('showStatus'));
Router::get('/status/create', fn()=> loadView('dashboard/create-status'));
Router::post('/status/create', fn()=> loadController('createStatus'));

Router::get('/branch', fn()=> (new BranchController())->index());
Router::get('/branch/create', fn()=> loadView('dashboard/create-branch'));
Router::post('/branch/create', fn()=> (new BranchController())->create());

Router::get('/login', fn()=> loadView('auth/login'), 'guest');
Router::post('/login', fn()=> (new UserController())->login());
Router::get('/signup', fn()=> loadView('auth/signup'), 'guest');
Router::post('/signup', fn()=> (new UserController())->create(), 'guest');

Router::get('/forget/password', fn()=> loadController('forgetPassword'));

Router::get('/admin', fn() => loadView('dashboard/home'), 'auth');
Router::get('/admin/ads', fn() => loadView('dashboard/home'), 'auth');
Router::get('/admin/branches', fn() => loadView('dashboard/home'), 'auth');

Router::get('/profile', fn() => (new \Controller\UserController())->loadProfile());

Router::get('/search', fn()=> (new AdController())->search());

Router::errorResponse(404, 'Not Found');