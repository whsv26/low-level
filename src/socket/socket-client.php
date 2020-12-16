<?php

declare(strict_types=1);

require_once "../../vendor/autoload.php";

$clientSocketFd = stream_socket_client('tcp://localhost:8222');

if ($clientSocketFd) {
    while (!feof($clientSocketFd)) {
        echo stream_get_line($clientSocketFd, 256, PHP_EOL) . PHP_EOL;
    }

    fclose($clientSocketFd);
}









