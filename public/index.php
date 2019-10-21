<?php
declare(strict_types=1);

define('ROOTPATH', dirname(__DIR__) . '/app');

require_once dirname(__DIR__) . '/vendor/autoload.php';

\App\Components\App::init();
\App\Components\App::$kernel->launch();
