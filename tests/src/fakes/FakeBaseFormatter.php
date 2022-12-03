<?php

declare(strict_types=1);

namespace  vadimcontenthunter\MyLogger\Tests\src\fakes;

use vadimcontenthunter\MyLogger\formatters\BaseFormatter;

/**
 * Фейковый класс BaseFormatter. переопределяет SET методы.
 *
 * @package MyLogger_Tests_Fakes
 * @author Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
class FakeBaseFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->message = '';
        $this->index = '';
        $this->statusLog = '';
        $this->dateTime = '';
    }

    /**
     * Метод для установки protected значений.
     *
     * @param string $_message
     * @return FakeBaseFormatter
     */
    public function setMessageLogFake(string $_message = ''): FakeBaseFormatter
    {
        $this->message = $_message;
        return $this;
    }

    public function setIndexLogFake(string $_index = ''): FakeBaseFormatter
    {
        $this->index = $_index;
        return $this;
    }

    public function setStatusLogFake(string $_statusLog): FakeBaseFormatter
    {
        $this->statusLog = $_statusLog;
        return $this;
    }

    public function setDateTimeFake(string $_dataTime = ''): FakeBaseFormatter
    {
        $this->dateTime = $_dataTime;
        return $this;
    }
}
