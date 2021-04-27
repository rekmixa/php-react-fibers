<?php

use React\EventLoop\Factory;
use Trowski\ReactFiber\FiberLoop;

require \dirname(__DIR__) . '/vendor/autoload.php';

$loop = new FiberLoop(Factory::create());

$loop->await($loop->async(static function () {
  echo 'Hello, World!' . PHP_EOL;
}));
