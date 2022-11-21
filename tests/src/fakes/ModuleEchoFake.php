<?php

declare(strict_types=1);

namespace  vadimcontenthunter\MyLogger\Tests\src\fakes;

use Psr\Log\LoggerInterface;
use vadimcontenthunter\MyLogger\interfaces\Formatter;

class ModuleEchoFake implements LoggerInterface
{
    public function __construct(protected string $formatterClass)
    {
    }

    public function specialMethod(string $param): ModuleEchoFake
    {
        echo 'This is a special method!';
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
    public function emergency(string|\Stringable $message, array $context = []): ModuleEchoFake
    {
        $formatter = new $this->formatterClass();
        if ($formatter instanceof Formatter) {
            $formatter->setMessageLog($message, $context);
        } else {
            throw new \Psr\Log\InvalidArgumentException("Error formatter does not conform to Formatter interface");
        }

        return $this;
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
     */
    public function alert(string|\Stringable $message, array $context = []): ModuleEchoFake
    {
        return $this;
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
     */
    public function critical(string|\Stringable $message, array $context = []): ModuleEchoFake
    {
        return $this;
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return ModuleEchoFake
     */
    public function error(string|\Stringable $message, array $context = []): ModuleEchoFake
    {
        return $this;
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
     */
    public function warning(string|\Stringable $message, array $context = []): ModuleEchoFake
    {
        return $this;
    }

    /**
     * Normal but significant events.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return ModuleEchoFake
     */
    public function notice(string|\Stringable $message, array $context = []): ModuleEchoFake
    {
        return $this;
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
     */
    public function info(string|\Stringable $message, array $context = []): ModuleEchoFake
    {
        return $this;
    }

    /**
     * Detailed debug information.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return ModuleEchoFake
     */
    public function debug(string|\Stringable $message, array $context = []): ModuleEchoFake
    {
        return $this;
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
    public function log($level, string|\Stringable $message, array $context = []): ModuleEchoFake
    {
        return $this;
    }
}
