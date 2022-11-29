<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\exceptions;

/**
 * Исключение сообщает о том что был получен неверный результат.
 *
 * @package   MyLogger_Exceptions
 * @author    Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
class WrongExpectedResultException extends MyLoggerException
{
    /**
     * Initializes the WrongExpectedResultException
     *
     * @param string $_message
     */
    public function __construct(string $_message)
    {
        $this->message = $_message;
    }
}
