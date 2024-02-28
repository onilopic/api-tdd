<?php

$routes = [
    [
        'GET',
        '/books/{id:\d+}',
        static fn () => new \App\Http\Response()
    ]
];

return $routes;
