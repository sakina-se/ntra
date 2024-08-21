<?php

declare(strict_types=1);

use App\Router;

Router::get('/', fn()=> loadController('home'));

Router::get('/ads/{id}', function (int $id) {
    loadController('showAd', ['id'=>$id]);
});


Router::get('/ads/create', fn()=> loadView('admin/create-ad'));
Router::post('/ads/create', fn()=> loadController('createAd'));

Router::get('/status', fn()=> loadController('showStatus'));
Router::get('/status/create', fn()=> loadView('admin/create-status'));
Router::post('/status/create', fn()=> loadController('createStatus'));

Router::get('/branch', fn()=> loadController('showBranches'));
Router::get('/branch/create', fn()=> loadView('admin/create-branch'));
Router::post('/branch/create', fn()=> loadController('createBranch'));

Router::get('/login', fn()=> loadController('login'));
Router::get('/signup', fn()=> loadController('signup'));

Router::get('/forget/password', fn()=> loadController('forgetPassword'));



Router::errorResponse(404, 'Not Found');
