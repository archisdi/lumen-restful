<?php

$router->get('/', function () {
    return api_response('welcome to lumen-api-server');
});

$router->post('/login', 'AuthController@login');
$router->get('/profile', 'UserController@profile');