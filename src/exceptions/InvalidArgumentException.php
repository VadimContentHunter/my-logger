<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\exceptions;

/**
 * Исключение сообщает о неправильном аргументе метода.
 *
 * @package   MyLogger_Exceptions
 * @author    Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
class InvalidArgumentException extends MyLoggerException
{
    /**
     * Initializes the InvalidArgumentException
     *
     * @param string $_message
     */
    public function __construct(string $_message)
    {
        $this->message = $_message;
    }
}
