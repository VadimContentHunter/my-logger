<?php

declare(strict_types=1);

namespace  vadimcontenthunter\MyLogger\Tests\src\fakes;

use Psr\Log\LoggerInterface;
use vadimcontenthunter\MyLogger\MyLogger;

class MyLoggerFake extends MyLogger
{
    /**
     * Поддельный тестовый метод для вывода защищенного списка данных логгеров
     *
     * @return array
     */
    public function fakeGetListLoggers(): array
    {
        return $this->loggers;
    }

    /**
     *  Поддельный тестовый метод, добавляющий в защищенный список логгеров, данные
     *
     * @param array|LoggerInterface $_loggers
     *
     * @return MyLoggerFake
     */
    public function fakeAddToListLoggers(array|LoggerInterface $_loggers): MyLoggerFake
    {
        $arrLoggers = is_array($_loggers) ? $_loggers : [$_loggers];
        $this->loggers += $arrLoggers;
        return $this;
    }
}
