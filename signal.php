<?php

/**
 * required to pcntl_signal to work
 */
declare(ticks=1);

require_once "vendor/autoload.php";

class Handler {
    const signalHandler = '\signalHandler';
    const tickHandler = '\tickHandler';
}

function signalHandler (int $signum) {
    echo "$signum intercepted" . PHP_EOL;
    exit(0);
}

function tickHandler () {
    echo "tick" . PHP_EOL;
}

/**
 * invoke handler every statement tick
 */
register_tick_function(Handler::tickHandler);

/**
 * ctrl+c
 * graceful shutdown
 */
pcntl_signal(SIGINT, Handler::signalHandler);

/**
 * kill <pid> default behaviour
 * signal always received from external process
 */
pcntl_signal(SIGTERM, Handler::signalHandler);

/**
 * ctrl+z
 * suspend to background
 * fg <job_number> to restore
 * jobs to show background tasks
 */
pcntl_signal(SIGTSTP, Handler::signalHandler);

while (true) {
    sleep(1);
}