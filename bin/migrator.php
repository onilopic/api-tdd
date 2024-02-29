#!/usr/bin/env php
<?php

// Autoloading
require 'vendor/autoload.php';

// Container
/** @var \League\Container\Container $container */
$container = require 'config/services.php';

$container->add(\App\Command\Migrate::class)->addArguments([
    \App\Database\Connection::class,
    'migrations_folder'
]);

/** @var \App\Command\Migrate $migrate */
$migrate = $container->get(\App\Command\Migrate::class);

$migrate->execute();

