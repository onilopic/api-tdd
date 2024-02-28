<?php

declare(strict_types=1);

namespace App\Http;

use App\Routing\Router;

class Kernel
{
    public function __construct(
        private readonly Router $router
    )
    {
    }

    public function handle(Request $request): Response
    {
        return $this->router->dispatch($request);
    }
}