<?php

/**
 * Instead of declare(ticks=1)
 * For performance boost
 */
pcntl_async_signals(true);

$serverSocketFd = stream_socket_server(
    'tcp://localhost:8222',
    $errno,
    $errstr,
    STREAM_SERVER_BIND | STREAM_SERVER_LISTEN
);

if (!$serverSocketFd) {
    exit(1);
}

pcntl_signal(SIGINT, function () use ($serverSocketFd) {
    fclose($serverSocketFd);
    echo 'Manually terminated' . PHP_EOL;

    exit(0);
});

stream_set_blocking($serverSocketFd, false);

while (true) {
    set_error_handler(function ($errno, $errstr, $errfile, $errline, $errcontext = null) {
        // ignore syscall interruptions and accept timeouts
    });

    $connection = stream_socket_accept($serverSocketFd, 10, $peer);

    restore_error_handler();

    if ($connection) {
        fputs($connection, sprintf('Peer: %s', $peer) . PHP_EOL);
        fputs($connection, sprintf('Timestamp: %s', date('Y-m-d H:i:s')));

        fclose($connection);
    }
}

