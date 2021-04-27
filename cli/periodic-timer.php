<?php

use React\EventLoop\Factory;
use Trowski\ReactFiber\FiberLoop;

require \dirname(__DIR__) . '/vendor/autoload.php';

$loop = new FiberLoop(Factory::create());

$loop->addPeriodicTimer(1, static function (): void {
  echo '(' . date('H:i:s') . ') Tick...' . PHP_EOL;
});

$loop->addPeriodicTimer(2, static function (): void {
  echo '(' . date('H:i:s') . ') Tack...' . PHP_EOL;
});

$loop->run();
