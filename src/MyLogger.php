<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Psr\Log\NullLogger;
use Stringable;
use Exception;
use vadimcontenthunter\MyLogger\exceptions\NoLoggerException;

/**
 * Класс является точкой входа для цепочного логирования.
 *
 * Благодаря этому можно подключать несколько логгеров `и реализовывать для них общее логирование.
 *
 * @package   MyLogger
 * @author    Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
class MyLogger implements LoggerInterface
{
    protected array $loggers;

    /**
     * Initializes the MyLogger
     *
     * @param array<LoggerInterface>|LoggerInterface $_loggers Список логгеров, которые будут
     *                                                         вызываться. Или конкретный логгер
     */
    public function __construct(array|LoggerInterface $_loggers = [new NullLogger()])
    {
        if (is_array($_loggers)) {
            $this->loggers = $_loggers;
        } else {
            $this->loggers = [$_loggers];
        }
        $this->checkLoggers();
    }

    /**
     * Проверяет каждый элемент списка логгеров на соответствию интерфейса "LoggerInterface".
     * Если элемент не будет соответствовать интерфейсу, тогда метод выбросит исключение
     *
     * @throws NoLoggerException
     * @return void
     */
    protected function checkLoggers(): void
    {
        foreach ($this->loggers as $logger) {
            if (!($logger instanceof LoggerInterface)) {
                throw new NoLoggerException();
            }
        }
    }

    /**
     * System is unusable.
     *
     * @param string|Stringable $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function emergency(string|Stringable $message, array $context = []): void
    {
    }

     /**
      * Action must be taken immediately.
      *
      * Example: Entire website down, database unavailable, etc. This should
      * trigger the SMS alerts and wake you up.
      *
      * @param string|Stringable $message
      * @param mixed[] $context
      *
      * @return void
      */
    public function alert(string|Stringable $message, array $context = []): void
    {
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string|Stringable $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function critical(string|Stringable $message, array $context = []): void
    {
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string|Stringable $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function error(string|Stringable $message, array $context = []): void
    {
    }

     /**
      * Normal but significant events.
      *
      * @param string|Stringable $message
      * @param mixed[] $context
      *
      * @return void
      */
    public function warning(string|Stringable $message, array $context = []): void
    {
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string|Stringable $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function notice(string|Stringable $message, array $context = []): void
    {
    }

     /**
      * Detailed debug information.
      *
      * @param string|Stringable $message
      * @param mixed[] $context
      *
      * @return void
      */
    public function info(string|Stringable $message, array $context = []): void
    {
    }

     /**
      * Detailed debug information.
      *
      * @param string|Stringable $message
      * @param mixed[] $context
      *
      * @return void
      */
    public function debug(string|Stringable $message, array $context = []): void
    {
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed   $level
     * @param string|Stringable $message
     * @param mixed[] $context
     *
     * @return void
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function log(LogLevel $level, string|Stringable $message, array $context = []): void
    {
    }
}
