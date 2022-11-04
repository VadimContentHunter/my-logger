<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\formatters;

use vadimcontenthunter\MyLogger\interfaces\Formatter;

class BaseFormatter implements Formatter
{
    /**
     *
     * @param \Stringable|string $message
     * @param array $context
     *
     * @return string
     */
    public function getMessage(\Stringable|string $message, array $context = array()): string
    {
        return '';
    }
}
