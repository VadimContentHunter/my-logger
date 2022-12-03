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
     * @param string|null $_statusLog Статус для лога
     * @param \Stringable|string|null $_message   Входная строка, которая будет отформатирована.
     *                                            Имена заполнителей ДОЛЖНЫ быть разделены одной открывающей фигурной скобкой { и одной закрывающей скобкой }.
     *                                            НЕ ДОЛЖНЫ быть пробелы между разделителями и именем заполнителя.
     *                                            Имена заполнителей ДОЛЖНЫ состоять только из символов "A-Z, a-z, 0-9", символа подчеркивания "_" и точки ".".
     * @param array|null $_context   Контекст данных для заполнителей, массив должен иметь следующий вид:
     *                               ```php
     *                               [
     *                               "name_placeholder" => "replacement string"
     *                               ]
     * @param array|null $_indexes   Существующие индексы. Нужны для генерации индекса не похожего на один из этого списка.
     */
    public function __construct(
        ?string $_statusLog = null,
        \Stringable|string|null $_message = null,
        array $_context = [],
        array $_indexes = [],
    ) {
        if ($_statusLog !== null) {
            $this->setStatusLog($_statusLog);
        }

        if ($_message !== null) {
            $this->setMessageLog($_message, $_context);
        }

        $this->setIndexLog($_indexes);
        $this->setDateTime();
    }

    /**
     * Форматирует строку для описания лога
     *
     * @param \Stringable|string  $message Входная строка, которая будет отформатирована.
     *                                     * Имена заполнителей ДОЛЖНЫ быть разделены одной открывающей фигурной скобкой { и одной закрывающей скобкой }.
     *                                     * НЕ ДОЛЖНЫ быть пробелы между разделителями и именем заполнителя.
     *                                     * Имена заполнителей ДОЛЖНЫ состоять только из символов "A-Z, a-z, 0-9", символа подчеркивания "_" и точки ".".
     *                                     * Длина должна быть больше или равна 1 символу.
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
        $messageForInvalidArgumentException = "Placeholder key formatting error. Rules for placeholder:
            Placeholder names MUST be separated by one opening brace { and one closing brace }.
            There MUST NOT be spaces between delimiters and the placeholder name.
            Placeholder names MUST only consist of the characters 'A-Z, a-z, 0-9', the underscore character '_', and the period '.'.";

        // Checking the message for valid placeholders
        $messageSymbols = str_split($message);
        $correctPlaceholder = true;
        foreach ($messageSymbols as $key => $symbol) {
            //Checking for the use of Cyrillic in placeholder
            if (preg_match("~[А-Яа-я]~", $symbol) && !$correctPlaceholder) {
                break;
            } elseif ($symbol === '{' && !$correctPlaceholder) {
                break;
            } elseif ($symbol === '}' && $correctPlaceholder) {
                $correctPlaceholder = false;
                break;
            } elseif ($symbol === '{' && $correctPlaceholder) {
                $correctPlaceholder = false;
            } elseif ($symbol === '}' && !$correctPlaceholder) {
                $correctPlaceholder = true;
            }
        }
        if (!$correctPlaceholder) {
            throw new \Psr\Log\InvalidArgumentException($messageForInvalidArgumentException);
        }

        // build a replacement array with braces around the context keys
        $replace = array();
        foreach ($context as $key => $val) {
            // check that the value can be cast to string
            if (is_string($val) || (is_object($val) && method_exists($val, '__toString'))) {
                if (
                    (is_string($key) || (is_object($key) && method_exists($key, '__toString')))
                    && preg_match('~^[\w.]+$~u', $key)
                    && !(bool)preg_match("~[А-Яа-я]~", $key)
                ) {
                    $replace['{' . $key . '}'] = $val;
                } else {
                    throw new \Psr\Log\InvalidArgumentException($messageForInvalidArgumentException);
                }
            } else {
                throw new \Psr\Log\InvalidArgumentException("Value must be a string.");
            }
        }

        // Checking a message for valid content in placeholders
        $resultMatchPlaceholder = preg_match_all('~{[^{}]+}~u', $message, $matchesPlaceholder);
        $matchesPlaceholder = $matchesPlaceholder[0] ?? null;
        $arrFilter = [];
        if ($matchesPlaceholder !== null) {
            $arrFilter = array_filter($matchesPlaceholder, fn(string $placeholder): bool => (bool)preg_match('~^{[\w.]+}$~u', $placeholder));
        }
        if (
            $resultMatchPlaceholder === false
            || $matchesPlaceholder === null
            || count($matchesPlaceholder) > count($context)
            || count($matchesPlaceholder) !== count($arrFilter)
        ) {
            throw new \Psr\Log\InvalidArgumentException($messageForInvalidArgumentException);
        }

        // interpolate replacement values into the message and return
        $this->message = strtr($message, $replace);
        return $this;
    }

    /**
     * Устанавливает индекс для лога
     *
     * @param array<Formatter|string> $indexes Существующие индексы. Нужны для генерации индекса не похожего на один из этого списка.
     *                                         Индексы формируются по порядку возрастания и заполняют пропущенные индексы в том же порядке.
     *
     * @return BaseFormatter
     */
    public function setIndexLog(array $indexes): BaseFormatter
    {
        $startIndex = 1;
        for ($i = 0; $i <= count($indexes); $i++) {
            foreach ($indexes as $key => $index) {
                if (
                    $index instanceof Formatter
                    && is_numeric($index->getIndexLog())
                    && (int) $index->getIndexLog() === $startIndex
                ) {
                    $startIndex++;
                } elseif (is_numeric($index) && (int) $index === $startIndex) {
                    $startIndex++;
                }
            }
        }

        $this->index = str_pad((string)$startIndex, 5, "0", STR_PAD_LEFT);

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
        $this->statusLog = match ($statusLog) {
            LogLevel::ALERT => LogLevel::ALERT,
            LogLevel::CRITICAL => LogLevel::CRITICAL,
            LogLevel::DEBUG => LogLevel::DEBUG,
            LogLevel::EMERGENCY => LogLevel::EMERGENCY,
            LogLevel::ERROR => LogLevel::ERROR,
            LogLevel::INFO => LogLevel::INFO,
            LogLevel::NOTICE => LogLevel::NOTICE,
            LogLevel::WARNING => LogLevel::WARNING,
            default => throw new \Psr\Log\InvalidArgumentException('Status is indeterminate'),
        };

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
