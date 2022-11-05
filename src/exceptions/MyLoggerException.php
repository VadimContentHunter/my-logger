<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\exceptions;

class MyLoggerException extends \Exception
{
    public function __construct(string $_message = "")
    {
        $this->message = $_message;
    }
}
