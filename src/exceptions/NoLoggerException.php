<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\exceptions;

/**
 * Исключение сообщает о том что класс не соответствует интерфейсу 'LoggerInterface'.
 *
 * @package   MyLogger_Exceptions
 * @author    Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
class NoLoggerException extends MyLoggerException
{
    /**
     * Initializes the NoLoggerException
     */
    public function __construct()
    {
        $this->message = "This logger does not match the interface 'LoggerInterface'";
    }
}
