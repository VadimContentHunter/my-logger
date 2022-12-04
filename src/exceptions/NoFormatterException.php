<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\exceptions;

/**
 * Исключение сообщает о том что форматер класс не соответствует интерфейсу 'Formatter'.
 *
 * @package   MyLogger_Exceptions
 * @author    Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
class NoFormatterException extends MyLoggerException
{
    /**
     * Initializes the NoFormatterException
     */
    public function __construct()
    {
        $this->message = "The formatter does not match the interface 'vadimcontenthunter\MyLogger\interfaces\Formatter'.";
    }
}
