<?php
use Slim\Http\Request;
use Slim\Http\Response;

// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

// Set Res to be JSON
$app->add(function ($request, $response, $next) {
    $response = $next($request, $response);
    return $response->withHeader('Content-Type', 'application/json');
});