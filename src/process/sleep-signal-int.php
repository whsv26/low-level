<?php

declare(strict_types=1);

require_once "../../vendor/autoload.php";

use function Lib\println;

$handler = function (int $sig) {
    println('SIGINT received');
};

/**
 * Диспатчатся только незаблокированные сигналы.
 *
 * Заблокированные сигналы не теряются
 * и вызываются после разблокировки и вывоза @see pcntl_signal_dispatch
 */

pcntl_signal(SIGINT, $handler);

pcntl_sigprocmask(SIG_BLOCK, [SIGINT]);
posix_kill(posix_getpid(), SIGINT);

$remainingSecs = sleep(5);

pcntl_signal_dispatch(); // не диспатчит заблокированный SIGINT

pcntl_sigprocmask(SIG_UNBLOCK, [SIGINT]);

println("Remaining seconds: $remainingSecs");

pcntl_signal_dispatch(); // диспатчит разблокированный SIGINT

println('after sleep');
