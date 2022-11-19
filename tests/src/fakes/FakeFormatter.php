<?php

declare(strict_types=1);

namespace  vadimcontenthunter\MyLogger\Tests\src\fakes;

use Psr\Log\LogLevel;
use vadimcontenthunter\MyLogger\interfaces\Formatter;

class FakeFormatter implements Formatter
{
    protected string $logLevel;

    public function setStatusLog(string $_logLevel): FakeFormatter
    {
        $this->logLevel = $_logLevel;
        return $this;
    }

    /**
     * Метод возвращает отформатированное сообщение
     *
     * @return string
     */
    public function getMessageLog(): string
    {
        return 'This is just a test message.';
    }

    /**
     * Возвращает уникальный индекс лога
     *
     * @return string
     */
    public function getIndexLog(): string
    {
        return '00001';
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
        return '2001-03-10 17:16:18';
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
