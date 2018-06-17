<?php

namespace App;

require __DIR__.'/../../vendor/autoload.php';

$application = new \Symfony\Component\Console\Application('App', 'v1.0');
$application->add(new \App\Command\GameCommand());
$application->run();

