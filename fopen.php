<?php

require_once "vendor/autoload.php";

function println(string $line): void {
    echo $line . PHP_EOL;
}

$tmpFile = tempnam(sys_get_temp_dir(), '');
println($tmpFile);

exec("rm $tmpFile");

for ($i = 0; $i < 10000; $i++) {
    exec(sprintf('echo "%s" >> %s', ...[
        $i,
        $tmpFile
    ]));
}

$descriptor = fopen($tmpFile, 'r');
echo (string) $descriptor;

do {
    $line = stream_get_line($descriptor, 10, PHP_EOL);
    println($line);
} while ($line !== false);

fclose($descriptor);