<?php

declare(strict_types=1);

namespace App\Http;

use App\Http\Middleware\RequestHandlerInterface;

class Kernel
{
    public function __construct(
        private readonly RequestHandlerInterface $requestHandler
    )
    {
    }

    public function handle(Request $request): Response
    {
        return $this->requestHandler->handle($request);
    }
}