<?php

declare(strict_types=1);

namespace  vadimcontenthunter\MyLogger\Tests\src\fakes;

use vadimcontenthunter\MyLogger\interfaces\Formatter;
use vadimcontenthunter\MyLogger\modules\ConsoleLogger;

class FakeConsoleLogger extends ConsoleLogger
{
    /**
     * Выводит список сохраненных логов
     *
     * @return array
     */
    public function getListLogsFake(): array
    {
        return $this->listLogs;
    }

    public function addLogMessageInListLogsFake(Formatter|array $formatter): void
    {
        $this->addLogMessageInListLogs($formatter);
    }
}
