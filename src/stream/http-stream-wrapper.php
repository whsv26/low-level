<?php

function println(string $line): void {
    echo $line . PHP_EOL;
}

$httpContext = stream_context_create([
    'http' => [
        'method' => 'GET',
        'header' => 'Accept: application/json',
    ]
]);

$descriptor = fopen('http://jsonplaceholder.typicode.com/photos', 'r', false, $httpContext);

do {
    $line = stream_get_line($descriptor, 100, PHP_EOL);
    println($line);
} while ($line !== false);

fclose($descriptor);