<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\exceptions;

/**
 * Исключение сообщает о неверной генерации сообщений.
 *
 * @package   MyLogger_Exceptions
 * @author    Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
class IncorrectMessageGenerationException extends MyLoggerException
{
    /**
     * Initializes the IncorrectMessageGenerationException
     *
     * @param mixed $_message
     */
    public function __construct($_message = 'Incorrect message generation')
    {
        $this->message = $_message;
    }
}
