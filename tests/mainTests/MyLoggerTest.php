<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\mainTests;

use Psr\Log\LogLevel;
use PHPUnit\Framework\TestCase;
use vadimcontenthunter\MyLogger\interfaces\Formatter;
use vadimcontenthunter\MyLogger\Tests\src\fakes\MyLoggerFake;
use vadimcontenthunter\MyLogger\Tests\src\fakes\FakeFormatter;
use vadimcontenthunter\MyLogger\Tests\src\fakes\ModuleEchoFake;

class MyLoggerTest extends TestCase
{
    protected ModuleEchoFake $moduleEchoFake;
    protected FakeFormatter $fakeFormatter;

    protected MyLoggerFake $myLoggerFake;

    public function setUp(): void
    {
        $this->fakeFormatter = new FakeFormatter();
        $this->moduleEchoFake = new ModuleEchoFake();
        $this->myLoggerFake = new MyLoggerFake($this->moduleEchoFake);
    }

    public function test_emergency_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        // $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->myLoggerFake->emergency($this->fakeFormatter->getMessageLog());
    }
}
