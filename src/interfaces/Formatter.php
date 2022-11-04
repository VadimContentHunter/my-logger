<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\interfaces;

interface Formatter
{
    public function getMessage(\Stringable|string $message, array $context = []): string;
}
