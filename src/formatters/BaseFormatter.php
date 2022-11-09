<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\formatters;

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
     * Метод возвращает отформатированную строку
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
     * @return string
     */
    public function getMessage(\Stringable|string $message, array $context = array()): string
    {
        return '';
    }
}
