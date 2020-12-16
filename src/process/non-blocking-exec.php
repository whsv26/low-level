<?php

declare(strict_types=1);

require_once "../../vendor/autoload.php";

use function Lib\println;

// exec('nohup php child-process.php > /dev/null 2>&1 & echo $!', $pid);
exec('php child-process.php > /dev/null 2>&1 & echo $!', $pid);
println('my pid: ' . getmypid());
print_r($pid);

sleep(2);