<?php

declare(strict_types=1);

require_once "../../vendor/autoload.php";

use function Lib\println;

$lastActivity = time();
$interval = 1;

pcntl_signal(SIGALRM, function () use (&$lastActivity, $interval) {
    $diff = time() - $lastActivity;

    if ($diff < 1) {
        pcntl_alarm($interval);
        return;
    }

    println("[Keep going. I'm watching]");

    pcntl_alarm($interval);
});
pcntl_alarm($interval);

while(true) {
    pcntl_signal_dispatch();

    $read = [STDIN];
    $write = $except = [];

    pcntl_sigprocmask(SIG_BLOCK, [SIGALRM]);

    if (stream_select($read, $write, $except, 0, 500000)) {
        fgetc(STDIN);
        $lastActivity = time();
    }

    pcntl_sigprocmask(SIG_UNBLOCK, [SIGALRM]);
}
