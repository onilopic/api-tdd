<?php

use App\Http\Response;

it('returns a correct Response object', function(string $method, string $path, int $statusCode) {

    // ARRANGE
    $request = \App\Http\Request::create($method, $path);
    $handler =  static fn() => new Response();
    $routeHandlerResolver = Mockery::mock(\App\Routing\RouteHandlerResolver::class);
    $routeHandlerResolver->shouldReceive('resolve')
        ->andReturn($handler);
    $router = new \App\Routing\Router($routeHandlerResolver);

    $router->setRoutes([
        ['GET', '/foo', $handler]
    ]);

    // ACT
    $response = $router->dispatch($request);

    // ASSERT
    expect($response)
        ->toBeInstanceOf(Response::class)
        ->and($response->getStatusCode())->toBe($statusCode);

});

it('returns a 404 Response object if a route does not exist', function() {
    $request = \App\Http\Request::create('GET', '/foo');
    $handler = fn() => new Response();
    $routeHandlerResolver = Mockery::mock(\App\Routing\RouteHandlerResolver::class);
    $routeHandlerResolver->shouldReceive('resolve')
        ->andReturn($handler);
    $router = new \App\Routing\Router($routeHandlerResolver);
    $router->setRoutes([
        ['GET', '/bar', $handler]
    ]);

    // ACT
    $response = $router->dispatch($request);

    expect($response)
        ->toBeInstanceOf(Response::class)
        ->and($response->getStatusCode())->toBe(Response::HTTP_NOT_FOUND);
});

it('returns a 405 Response object if a not allowed method is used', function() {
    // ARRANGE
    $request = \App\Http\Request::create('GET', '/foo');
    $handler = static fn() => new Response();
    $routeHandlerResolver = Mockery::mock(\App\Routing\RouteHandlerResolver::class);
    $routeHandlerResolver->shouldReceive('resolve')
        ->andReturn($handler);
    $router = new \App\Routing\Router($routeHandlerResolver);
    $router->setRoutes([
        ['POST', '/foo', $handler]
    ]);

    // ACT
    $response = $router->dispatch($request);

    expect($response)
        ->toBeInstanceOf(Response::class)
        ->and($response->getStatusCode())->toBe(Response::HTTP_METHOD_NOT_ALLOWED);
})->todo();