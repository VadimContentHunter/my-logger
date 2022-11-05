<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\interfaces;

use vadimcontenthunter\MyLogger\exceptions\MyLoggerException;

interface Formatter
{
    /**
     * @param \Stringable|string $message
     * @param array $context
     * @throws MyLoggerException
     * @return string
     */
    public function getMessage(\Stringable|string $message, array $context = []): string;
}
