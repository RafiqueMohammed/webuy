<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});
//API Authentication -Skipping since its out of scope
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "path"=>["/webs/"],
    "ignore"=>["/webs/token"],
    "secret" => $app->getContainer()->get("settings")['SECRET_KEY_WEB']
]));
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
