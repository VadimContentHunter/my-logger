<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\modulesTests;

use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;
use vadimcontenthunter\MyLogger\modules\ConsoleLogger;
use vadimcontenthunter\MyLogger\Tests\src\fakes\FakeFormatter;
use vadimcontenthunter\MyLogger\Tests\src\providers\ProviderBaseFormatter;

class ConsoleLoggerTest extends TestCase
{
    protected ConsoleLogger $consoleLogger;
    protected FakeFormatter $fakeFormatter;

    public function setUp(): void
    {
        $this->fakeFormatter = new FakeFormatter();
        $this->consoleLogger = new ConsoleLogger($this->fakeFormatter::class);
    }

    public function test_emergency_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->consoleLogger->emergency($this->fakeFormatter->getMessageLog());
    }

    public function test_alert_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->consoleLogger->alert($this->fakeFormatter->getMessageLog());
    }

    public function test_critical_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->consoleLogger->critical($this->fakeFormatter->getMessageLog());
    }

    public function test_error_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->consoleLogger->error($this->fakeFormatter->getMessageLog());
    }

    public function test_warning_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->consoleLogger->warning($this->fakeFormatter->getMessageLog());
    }

    public function test_notice_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->consoleLogger->notice($this->fakeFormatter->getMessageLog());
    }

    public function test_info_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->consoleLogger->info($this->fakeFormatter->getMessageLog());
    }

    public function test_debug_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->consoleLogger->debug($this->fakeFormatter->getMessageLog());
    }

    public function test_getLogMessageFromListLogsById_withParameterId_shouldReturnLog(): void
    {
    }

    public function test_getLogMessageFromListLogsByIndex_withParameterIndex_shouldReturnLog(): void
    {
    }

    public function test_getLogMessageFromListLogsByStatusLog_withParameterStatusLog_shouldReturnAllLogsWithStatus(): void
    {
    }

    public function test_getLogMessageFromListLogsByDataTime_withParametersStartAndEndDateTime_shouldReturnAllLogsFromDatetimeInterval(): void
    {
    }

    public function test_getLogMessageFromListLogsByMessage_withParameterMessage_shouldReturnLog(): void
    {
    }

    public function test_addLogMessageInListLogs_withParameterFormatter_shouldAddToTheList(): void
    {
    }

    /**
     * @param string $logLevel
     *
     * @return void
     *
     * @dataProvider providerLogLevels
     */
    public function test_log_withMessageAndContext_shouldWriteAMessageToTheConsole(string $logLevel): void
    {
    }

    public function providerLogLevels(): array
    {
        return [
            LogLevel::ALERT,
            LogLevel::CRITICAL,
            LogLevel::DEBUG,
            LogLevel::EMERGENCY,
            LogLevel::ERROR,
            LogLevel::INFO,
            LogLevel::NOTICE,
            LogLevel::WARNING,
        ];
    }
}
