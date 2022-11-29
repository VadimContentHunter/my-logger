<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\formatters;

use Psr\Log\LogLevel;
use vadimcontenthunter\MyLogger\interfaces\Formatter;

/**
 * Класс следует правилам форматированию сообщения из "PSR-3: Logger Interface"
 *
 * @package   MyLogger_Formatters
 * @author    Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
class BaseFormatter implements Formatter
{
    /**
     * Описание лога
     *
     * @var string
     */
    protected string $message = '';

    /**
     * Уникальный индекс
     *
     * @var string
     */
    protected string $index = '';

    /**
     * Статус лога
     *
     * @var string
     */
    protected string $statusLog = '';

    /**
     * Дата и время лога
     *
     * @var string
     */
    protected string $dateTime = '';

    /**
     * Initializes the MyLogger
     *
     * @param string $_statusLog Статус для лога
     * @param \Stringable|string $_message   Входная строка, которая будет отформатирована.
     *                                       Имена заполнителей ДОЛЖНЫ быть разделены одной открывающей фигурной скобкой { и одной закрывающей скобкой }.
     *                                       НЕ ДОЛЖНЫ быть пробелы между разделителями и именем заполнителя.
     *                                       Имена заполнителей ДОЛЖНЫ состоять только из символов "A-Z, a-z, 0-9", символа подчеркивания "_" и точки ".".
     * @param array $_context   Контекст данных для заполнителей, массив должен иметь следующий вид:
     *                          ```php
     *                          [
     *                          "name_placeholder" => "replacement string"
     *                          ]
     * @param array $_indexes   Существующие индексы. Нужны для генерации индекса не похожего на один из этого списка.
     */
    public function __construct(
        string $_statusLog = '',
        \Stringable|string $_message = '',
        array $_context = [],
        array $_indexes = []
    ) {
        $this->setIndexLog($_indexes);
        $this->setDateTime();
        $this->setStatusLog($_statusLog);
        $this->setMessageLog($_message, $_context);
    }

    /**
     * Форматирует строку для описания лога
     *
     * @param \Stringable|string  $message Входная строка, которая будет отформатирована.
     *                                     * Имена заполнителей ДОЛЖНЫ быть разделены одной открывающей фигурной скобкой { и одной закрывающей скобкой }.
     *                                     * НЕ ДОЛЖНЫ быть пробелы между разделителями и именем заполнителя.
     *                                     * Имена заполнителей ДОЛЖНЫ состоять только из символов "A-Z, a-z, 0-9", символа подчеркивания "_" и точки ".".
     * @param array  $context Контекст данных для заполнителей, массив должен иметь следующий вид:
     *                        ```php
     *                        [
     *                        "name_placeholder" => "replacement string"
     *                        ]
     *
     * @return BaseFormatter
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function setMessageLog(\Stringable|string $message, array $context = array()): BaseFormatter
    {
        return $this;
    }

    /**
     * Устанавливает индекс для лога
     *
     * @param array $indexes Существующие индексы. Нужны для генерации индекса не похожего на один из этого списка.
     *
     * @return BaseFormatter
     */
    public function setIndexLog(array $indexes): BaseFormatter
    {
        return $this;
    }

    /**
     * Устанавливает статус для лога
     *
     * @param string $statusLog Статус для лога
     *
     * @return BaseFormatter
     */
    public function setStatusLog(string $statusLog): BaseFormatter
    {
        return $this;
    }

    /**
     * Устанавливает дату и время фиксации лога.
     * Формат: 2001-03-10 17:16:18;
     *
     * @return BaseFormatter
     */
    public function setDateTime(): BaseFormatter
    {
        $this->dateTime = date("Y-m-d H:i:s");
        return $this;
    }

    /**
     * Метод возвращает отформатированную строку
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
        return $this->statusLog;
    }

    /**
     * Возвращает дату и время фиксации лога
     *
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    /**
     * Генерация сообщения лога
     *
     * @return string
     */
    public function generateMessageLog(): string
    {
        return '[' . $this->getIndexLog() . '] ' . '[' . $this->getDateTime() . '] ' . '[' . $this->getStatusLog() . '] ' . $this->getMessageLog();
    }

    /**
     * Проверка правильности сгенерированного сообщения
     *
     * @param string $message Сообщение для проверки
     *
     * @return bool Возвращает true, в случае если сгенерированное сообщение соответствует формату иначе false.
     */
    public function checkGenerateMessage(string $message): bool
    {
        if (
            preg_match(
                '~^\[(?<index>\d{5})\]\s\[(?<date_time>\d{4,}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2})\]\s\[(?<log_level>\w*)\]\s(?<message>.*)$~iu',
                $message,
                $matches
            )
        ) {
            if (
                strcmp($matches['index'], $this->getIndexLog()) === 0 &&
                strcmp($matches['date_time'], $this->getDateTime()) === 0 &&
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
