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
     * @see signalHandler
     */
    const signalHandlerWithoutTermination = 'Lib\Handler::signalHandlerWithoutTermination';

    /**
     * @see tickHandler
     */
    const tickHandler = 'Lib\Handler::tickHandler';

    public static function signalHandler(int $signum) {
        echo "$signum intercepted" . PHP_EOL;
        exit(0);
    }

    public static function signalHandlerWithoutTermination(int $signum) {
        echo "$signum intercepted" . PHP_EOL;
    }

    public static function tickHandler() {
        echo "tick" . PHP_EOL;
    }
}