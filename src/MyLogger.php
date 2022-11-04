<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Stringable;
use Exception;
use vadimcontenthunter\MyLogger\formatters\BaseFormatter;
use vadimcontenthunter\MyLogger\interfaces\Formatter;

class MyLogger
{
    private array $loggers;

    private Formatter $formatter;

    /**
     * @param LoggerInterface[] $loggers
     */
    public function __construct(array $_loggers = [new NullLogger()], Formatter $_formatter = new BaseFormatter())
    {
        $this->loggers = $_loggers;
        $this->formatter = $_formatter;
        $this->checkLoggers();
    }

    /**
     * @throws Exception Тестовое исключение
     *
     * @return void
     */
    private function checkLoggers(): void
    {
        foreach ($this->loggers as $logger) {
            if (!($logger instanceof LoggerInterface)) {
                throw new Exception("Logger in array does not inherit interface LoggerInterface.");
            }
        }
    }

    public function emergency(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

    public function alert(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

    public function critical(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

    public function error(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

    public function warning(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

    public function notice(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

    public function info(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

    public function debug(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }
}
