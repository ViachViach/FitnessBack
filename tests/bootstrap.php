<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/config/bootstrap.php') === true) {
    require dirname(__DIR__).'/config/bootstrap.php';
} else if (method_exists(Dotenv::class, 'bootEnv') === true) {
    (new Dotenv())->loadEnv(dirname(__DIR__).'/.env');
}
