<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\exceptions;

/**
 * Исключение сообщает о том что не активирован флаг.
 *
 * @package   MyLogger_Exceptions
 * @author    Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
class NotEnabledFlagException extends MyLoggerException
{
    /**
     * Initializes the NotEnabledFlagException
     *
     * @param mixed $_message
     */
    public function __construct($_message = 'Not enabled flag')
    {
        $this->message = $_message;
    }
}
