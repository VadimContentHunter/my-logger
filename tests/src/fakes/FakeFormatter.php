<?php

declare(strict_types=1);

namespace  vadimcontenthunter\MyLogger\Tests\src\fakes;

use Psr\Log\LogLevel;
use vadimcontenthunter\MyLogger\interfaces\Formatter;

class FakeFormatter implements Formatter
{
    protected string $logLevel;

    protected string $message;

    protected string $index;

    protected string $dateTime;

    /**
     * @param string $_logLevel
     * @return FakeFormatter
     */
    public function setStatusLog(string $_logLevel): FakeFormatter
    {
        $this->logLevel = $_logLevel;
        return $this;
    }

    /**
     * @param string $_message
     * @return FakeFormatter
     */
    public function setMessageLog(\Stringable|string $_message = 'This is just a test message.', array $context = []): FakeFormatter
    {
        $this->message = $_message;
        return $this;
    }

    /**
     * @param string $_index
     * @return FakeFormatter
     */
    public function setIndexLog(string $_index = '00001'): FakeFormatter
    {
        $this->index = $_index;
        return $this;
    }

    /**
     * @param string $_index
     * @return FakeFormatter
     */
    public function setDateTime(string $_dateTime = '2001-03-10 17:16:18'): FakeFormatter
    {
        $this->dateTime = $_dateTime;
        return $this;
    }

    /**
     * Метод возвращает отформатированное сообщение
     *
     * @return string
     */
    public function getMessageLog(): string
    {
        return $this->message;
    }

    /**
     * Возвращает уникальный индекс лога
     *
     * @return string
     */
    public function getIndexLog(): string
    {
        return $this->index;
    }

    /**
     * Возвращает уровень лога
     *
     * @return string
     */
    public function getStatusLog(): string
    {
        return $this->logLevel;
    }

    /**
     * Возвращает дату и время фиксации лога
     *
     * @return string
     */
    public function getDataTime(): string
    {
        return $this->dateTime;
    }

    /**
     * Возвращает сгенерированную строку для лога
     *
     * @return string
     */
    public function generateMessageLog(): string
    {
        return '[' . $this->getIndexLog() . '] ' . '[' . $this->getDataTime() . '] ' . '[' . $this->getStatusLog() . '] ' . $this->getMessageLog();
    }

    /**
     * Проверка правильности сгенерированного сообщения
     * [00005] [2001-03-10 17:16:18] [error] message
     *
     * @param string $message Сообщение для проверки
     *
     * @return bool Возвращает true, в случае если сгенерированное сообщение соответствует формату иначе false.
     */
    public function checkGenerateMessage(string $message): bool
    {
        if (
            preg_match(
                '~^(?<index>\[\d{5}\])\s(?<date_time>\[\d{4,}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\])\s(?<log_level>\[\w*\])\s(?<message>.*)$~iu',
                $message,
                $matches
            )
        ) {
            if (
                strcmp($matches['index'], $this->getIndexLog()) === 0 &&
                strcmp($matches['date_time'], $this->getDataTime()) === 0 &&
                strcmp($matches['log_level'], $this->getStatusLog()) === 0 &&
                strcmp($matches['message'], $this->getMessageLog()) === 0
            ) {
                return true;
            }
            return false;
        }

        return false;
    }
}
