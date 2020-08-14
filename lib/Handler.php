<?php

declare(strict_types=1);

namespace Lib;

class Handler
{
    /**
     * @see signalHandler
     */
    const signalHandler = 'Lib\Handler::signalHandler';

    /**
     * @see tickHandler
     */
    const tickHandler = 'Lib\Handler::tickHandler';

    public static function signalHandler (int $signum) {
        echo "$signum intercepted" . PHP_EOL;
        exit(0);
    }

    public static function tickHandler () {
        echo "tick" . PHP_EOL;
    }
}