<?php

namespace Tests;

use App\Command\Migrate;
use App\Database\Connection;
use App\Http\Kernel;
use App\Http\Request;
use App\Http\Response;
use App\Routing\Router;
use League\Container\Container;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class ApiTestCase extends BaseTestCase
{
    protected Container $container;

    protected function setUp(): void
    {
        $this->container = include dirname(__DIR__) . '/config/services.php';
        $this->connection = $this->container->get(Connection::class);
    }

    public function json(
        string $method = 'GET',
        string $uri = '/',
        array  $data = [],
        array  $headers = []
    ): object
    {
        // Json encode the data
        $content = json_encode($data);
        // Merge server variables with $headers
        $server = array_merge([
            'CONTENT_TYPE' => 'application/json',
            'ACCEPT' => 'application/json'
        ], $headers);
        // Create a $request using a static named constructor
        $request = Request::create(
            method: $method,
            uri: $uri,
            server: $server,
            content: $content
        );

        //$router = new Router();
        //$router->setRoutes();

        // Create / resolve the kernel
        $kernel = $this->container->get(Kernel::class);

        //dd($kernel);
        // Obtain a $response object: $response = $kernel = $kernel->handle($request);
        $response = $kernel->handle($request);
        return $response;
    }

    public function migrateTestDatabase(): void
    {
        $connection = $this->container->get(Connection::class);
        $migrationsFolder = $this->container->get('migrations_folder');

        $migrate = new Migrate($connection, $migrationsFolder);

        $migrate->execute();
    }
}
