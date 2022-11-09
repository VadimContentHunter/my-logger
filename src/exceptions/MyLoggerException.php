<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\exceptions;

/**
 * Основной класс исключений для MyLogger
 *
 * @package   MyLogger_Exceptions
 * @author    Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
class MyLoggerException extends \Exception
{
    /**
     * Initializes the MyLoggerException
     *
     * @param string $_message Сообщение об исключении
     */
    public function __construct(string $_message = "Error MyLogger")
    {
        $this->message = $_message;
    }
}
