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
    private string $message = '';

    /**
     * Уникальный индекс
     *
     * @var string
     */
    private string $index = '';

    /**
     * Статус лога
     *
     * @var string
     */
    private string $statusLog = '';

    /**
     * Дата и время лога
     *
     * @var string
     */
    private string $dataTime = '';

    /**
     * Initializes the MyLogger
     *
     * @param string $_statusLog
     * @param \Stringable|string $_message
     * @param array $_context
     */
    public function __construct(
        string $_statusLog,
        \Stringable|string $_message,
        array $_context = array(),
    ) {
        $this->setIndexLog();
        $this->setDataTime();
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
     * @return BaseFormatter
     */
    public function setIndexLog(): BaseFormatter
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
    public function setDataTime(): BaseFormatter
    {
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
    public function getDataTime(): string
    {
        return $this->dataTime;
    }

    /**
     * Генерация сообщения лога
     *
     * @return string
     */
    public function generateMessageLog(): string
    {
        return '';
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
        return false;
    }
}
