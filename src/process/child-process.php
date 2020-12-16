<?php

declare(strict_types=1);
declare(ticks=1);

require_once "../../vendor/autoload.php";

/**
 * PPID for this script is PID of /lib/systemd/systemd --user
 * instead of sighup-process PID
 */

$signalHandler = function (int $signum) {
    exec(sprintf('echo "%s" >> ./child-process-output.tmp', "$signum intercepted" . PHP_EOL));
};

pcntl_signal(SIGINT, $signalHandler);
pcntl_signal(SIGTERM, $signalHandler);
pcntl_signal(SIGHUP, $signalHandler);

for ($i = 0; $i < 10; $i++) {
    exec('date >> ./child-process-output.tmp');
    sleep(1);
}


