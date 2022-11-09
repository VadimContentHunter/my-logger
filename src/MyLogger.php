<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Psr\Log\NullLogger;
use Stringable;
use Exception;
use vadimcontenthunter\MyLogger\exceptions\NoLoggerException;
use vadimcontenthunter\MyLogger\formatters\BaseFormatter;
use vadimcontenthunter\MyLogger\interfaces\Formatter;

/**
 * Класс является точкой входа для цепочного логирования.
 *
 * Благодаря этому можно подключать несколько логгеров и реализовывать для них общее логирование.
 *
 * @package   MyLogger
 * @author    Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
class MyLogger implements LoggerInterface
{
    private array $loggers;

    private Formatter $formatter;

    /**
     * Initializes the MyLogger
     *
     * @param array $_loggers   Список логгеров, которые будут вызываться.
     * @param Formatter $_formatter Форматер, который будет форматировать сообщения для логгера.
     */
    public function __construct(array $_loggers = [new NullLogger()], Formatter $_formatter = new BaseFormatter())
    {
        $this->loggers = $_loggers;
        $this->formatter = $_formatter;
        $this->checkLoggers();
    }

    /**
     * Проверяет каждый элемент списка логгеров на соответствию интерфейса "LoggerInterface".
     * Если элемент не будет соответствовать интерфейсу, тогда метод выбросит исключение
     *
     * @throws NoLoggerException
     * @return void
     */
    private function checkLoggers(): void
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
     * @param Formatter $_formatter
     *
     * @return void
     */
    public function emergency(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
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
      * @param Formatter $_formatter
      *
      * @return void
      */
    public function alert(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string|Stringable $message
     * @param mixed[] $context
     * @param Formatter $_formatter
     *
     * @return void
     */
    public function critical(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string|Stringable $message
     * @param mixed[] $context
     * @param Formatter $_formatter
     *
     * @return void
     */
    public function error(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

     /**
      * Normal but significant events.
      *
      * @param string|Stringable $message
      * @param mixed[] $context
      * @param Formatter $_formatter
      *
      * @return void
      */
    public function warning(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string|Stringable $message
     * @param mixed[] $context
     * @param Formatter $_formatter
     *
     * @return void
     */
    public function notice(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

     /**
      * Detailed debug information.
      *
      * @param string|Stringable $message
      * @param mixed[] $context
      * @param Formatter $_formatter
      *
      * @return void
      */
    public function info(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

     /**
      * Detailed debug information.
      *
      * @param string|Stringable $message
      * @param mixed[] $context
      * @param Formatter $_formatter
      *
      * @return void
      */
    public function debug(string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed   $level
     * @param string|Stringable $message
     * @param mixed[] $context
     * @param Formatter $_formatter
     *
     * @return void
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function log(LogLevel $level, string|Stringable $message, array $context = [], Formatter $_formatter = null): void
    {
    }
}
