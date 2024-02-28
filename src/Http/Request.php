<?php

namespace App\Http;

class Request
{
    public static function create(
        string $method,
        string $uri,
        iterable $server,
        string $content
    )
    {
        $uriParts = parse_uri($uri);

        return new self();
    }

    public function getQueryParams(): array
    {


        return ['black' => 'white', 'day'=> 'night'];
    }
}