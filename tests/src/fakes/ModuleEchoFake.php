<?php

declare(strict_types=1);

namespace  vadimcontenthunter\MyLogger\Tests\src\fakes;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use vadimcontenthunter\MyLogger\interfaces\Formatter;

class ModuleEchoFake implements LoggerInterface
{
    public function __construct(protected string $formatterClass)
    {
    }

    public function specialMethod(string $param): ModuleEchoFake
    {
        echo 'This is a special method! $param: ' . $param;
        return $this;
    }

    /**
     * System is unusable.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return ModuleEchoFake
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function emergency(string|\Stringable $message, array $context = []): void
    {
        $formatter = new $this->formatterClass();
        if ($formatter instanceof Formatter) {
            $formatter->setMessageLog($message, $context);
            $formatter->setStatusLog(LogLevel::EMERGENCY);
            echo $formatter->generateMessageLog();
        } else {
            throw new \Psr\Log\InvalidArgumentException("Error formatter does not conform to Formatter interface");
        }
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return ModuleEchoFake
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function alert(string|\Stringable $message, array $context = []): void
    {
        $formatter = new $this->formatterClass();
        if ($formatter instanceof Formatter) {
            $formatter->setMessageLog($message, $context);
            $formatter->setStatusLog(LogLevel::ALERT);
            echo $formatter->generateMessageLog();
        } else {
            throw new \Psr\Log\InvalidArgumentException("Error formatter does not conform to Formatter interface");
        }
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return ModuleEchoFake
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function critical(string|\Stringable $message, array $context = []): void
    {
        $formatter = new $this->formatterClass();
        if ($formatter instanceof Formatter) {
            $formatter->setMessageLog($message, $context);
            $formatter->setStatusLog(LogLevel::CRITICAL);
            echo $formatter->generateMessageLog();
        } else {
            throw new \Psr\Log\InvalidArgumentException("Error formatter does not conform to Formatter interface");
        }
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return ModuleEchoFake
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function error(string|\Stringable $message, array $context = []): void
    {
        $formatter = new $this->formatterClass();
        if ($formatter instanceof Formatter) {
            $formatter->setMessageLog($message, $context);
            $formatter->setStatusLog(LogLevel::ERROR);
            echo $formatter->generateMessageLog();
        } else {
            throw new \Psr\Log\InvalidArgumentException("Error formatter does not conform to Formatter interface");
        }
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return ModuleEchoFake
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function warning(string|\Stringable $message, array $context = []): void
    {
        $formatter = new $this->formatterClass();
        if ($formatter instanceof Formatter) {
            $formatter->setMessageLog($message, $context);
            $formatter->setStatusLog(LogLevel::WARNING);
            echo $formatter->generateMessageLog();
        } else {
            throw new \Psr\Log\InvalidArgumentException("Error formatter does not conform to Formatter interface");
        }
    }

    /**
     * Normal but significant events.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return ModuleEchoFake
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function notice(string|\Stringable $message, array $context = []): void
    {
        $formatter = new $this->formatterClass();
        if ($formatter instanceof Formatter) {
            $formatter->setMessageLog($message, $context);
            $formatter->setStatusLog(LogLevel::NOTICE);
            echo $formatter->generateMessageLog();
        } else {
            throw new \Psr\Log\InvalidArgumentException("Error formatter does not conform to Formatter interface");
        }
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return ModuleEchoFake
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function info(string|\Stringable $message, array $context = []): void
    {
        $formatter = new $this->formatterClass();
        if ($formatter instanceof Formatter) {
            $formatter->setMessageLog($message, $context);
            $formatter->setStatusLog(LogLevel::INFO);
            echo $formatter->generateMessageLog();
        } else {
            throw new \Psr\Log\InvalidArgumentException("Error formatter does not conform to Formatter interface");
        }
    }

    /**
     * Detailed debug information.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return ModuleEchoFake
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function debug(string|\Stringable $message, array $context = []): void
    {
        $formatter = new $this->formatterClass();
        if ($formatter instanceof Formatter) {
            $formatter->setMessageLog($message, $context);
            $formatter->setStatusLog(LogLevel::DEBUG);
            echo $formatter->generateMessageLog();
        } else {
            throw new \Psr\Log\InvalidArgumentException("Error formatter does not conform to Formatter interface");
        }
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed   $level
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return ModuleEchoFake
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function log($level, string|\Stringable $message, array $context = []): void
    {
        $formatter = new $this->formatterClass();
        if ($formatter instanceof Formatter) {
            $formatter->setMessageLog($message, $context);
            $formatter->setStatusLog($level);
            echo $formatter->generateMessageLog();
        } else {
            throw new \Psr\Log\InvalidArgumentException("Error formatter does not conform to Formatter interface");
        }
    }
}
