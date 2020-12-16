<?php

declare(strict_types=1);

use function Lib\println;

require_once "../../vendor/autoload.php";

/**
 * php wrapper
 * temp for in memory while there is free mem space
 * memory for in memory
 */
$descriptor = fopen('php://temp', 'rw');
echo (string) $descriptor . PHP_EOL;

for ($i = 0; $i < 10000; $i++) {
    fputs($descriptor, $i . PHP_EOL);
}

// print file pointer
echo sprintf('pointer: %s', ftell($descriptor) . PHP_EOL);

rewind($descriptor);

// print file pointer after rewind
echo sprintf('pointer after rewind: %s', ftell($descriptor) . PHP_EOL);

do {
    $line = stream_get_line($descriptor, 10, PHP_EOL);
    println($line);
} while ($line !== false);

fclose($descriptor);