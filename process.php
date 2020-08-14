<?php

require_once "vendor/autoload.php";

use Symfony\Component\Process\Process;
use Symfony\Component\Process\PhpProcess;

// ls
$lsProcess = new Process(['ls', '-la']);
$lsProcess->run(fn (string $output) => print($lsProcess->getOutput()));

// cat
$catProcess = new Process(['cat', 'composer.lock']);
$catProcess->start();

foreach ($catProcess as $type => $buffer) {
    echo $type . PHP_EOL . $buffer;
}

// php process with loop
$phpLoop = new PhpProcess('for ($i = 0; $i < 1000000; $i++) { echo $i; }');
$phpLoop->start();

while ($phpLoop->isRunning()) {
    echo 'process running' . PHP_EOL;
    usleep(10000);
}

