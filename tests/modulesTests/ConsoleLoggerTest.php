<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\modulesTests;

use Psr\Log\LogLevel;
use PHPUnit\Framework\TestCase;
use vadimcontenthunter\MyLogger\interfaces\Formatter;
use vadimcontenthunter\MyLogger\Tests\src\fakes\FakeFormatter;
use vadimcontenthunter\MyLogger\Tests\src\fakes\FakeConsoleLogger;

class ConsoleLoggerTest extends TestCase
{
    protected FakeConsoleLogger $fakeConsoleLogger;
    protected FakeFormatter $fakeFormatter;

    public function setUp(): void
    {
        $this->fakeFormatter = new FakeFormatter();
        $this->fakeConsoleLogger = new FakeConsoleLogger($this->fakeFormatter::class);
    }

    public function test_emergency_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->fakeConsoleLogger->emergency($this->fakeFormatter->getMessageLog());
    }

    public function test_alert_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->fakeConsoleLogger->alert($this->fakeFormatter->getMessageLog());
    }

    public function test_critical_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->fakeConsoleLogger->critical($this->fakeFormatter->getMessageLog());
    }

    public function test_error_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->fakeConsoleLogger->error($this->fakeFormatter->getMessageLog());
    }

    public function test_warning_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->fakeConsoleLogger->warning($this->fakeFormatter->getMessageLog());
    }

    public function test_notice_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->fakeConsoleLogger->notice($this->fakeFormatter->getMessageLog());
    }

    public function test_info_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->fakeConsoleLogger->info($this->fakeFormatter->getMessageLog());
    }

    public function test_debug_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $this->fakeFormatter->setStatusLog(LogLevel::EMERGENCY);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->fakeConsoleLogger->debug($this->fakeFormatter->getMessageLog());
    }

    /**
     * @param Formatter|array $formatter
     * @return void
     *
     * @dataProvider providerFormatters
     */
    public function test_addLogMessageInListLogs_withParameterFormatter_shouldAddToTheList(
        Formatter|array $formatter
    ): void {
        $this->fakeConsoleLogger->addLogMessageInListLogsFake($formatter);

        $arrFormatters = is_array($formatter) ? $formatter : [$formatter];
        $intersect = array_intersect($arrFormatters, $this->fakeConsoleLogger->getListLogsFake());
        if (count($arrFormatters) === count($intersect)) {
            $this->assertTrue(true);
        }

        $this->assertTrue(false);
    }

    /**
     * @param Formatter|array $formatter
     * @param int $id
     * @return void
     *
     * @dataProvider providerForGetLogMessageFromListLogsById
     */
    public function test_getLogMessageFromListLogsById_withParameterId_shouldReturnLog(
        Formatter|array $formatter,
        int $id
    ): void {
        $arrFormatters = is_array($formatter) ? $formatter : [$formatter];
        $this->fakeConsoleLogger->addLogMessageInListLogsFake($arrFormatters);
        if (count($this->fakeConsoleLogger->getListLogsFake()) > 0) {
            $resLog = $this->fakeConsoleLogger->getLogMessageFromListLogsById($id);
            if (strcmp($arrFormatters[$id]->generateMessageLog(), $resLog) === 0) {
                $this->assertTrue(true);
            }
        }
        $this->assertTrue(false);
    }

    /**
     * @param Formatter|array $formatter
     * @param string $index
     * @return void
     *
     * @dataProvider providerForGetLogMessageFromListLogsByIndex
     */
    public function test_getLogMessageFromListLogsByIndex_withParameterIndex_shouldReturnLog(
        Formatter|array $formatter,
        string $index
    ): void {
        $arrFormatters = is_array($formatter) ? $formatter : [$formatter];
        $this->fakeConsoleLogger->addLogMessageInListLogsFake($arrFormatters);
        if (count($this->fakeConsoleLogger->getListLogsFake()) > 0) {
            $resLog = $this->fakeConsoleLogger->getLogMessageFromListLogsByIndex($index);
            if (array_search($resLog, $arrFormatters)) {
                $this->assertTrue(true);
            }
        }
        $this->assertTrue(false);
    }

    /**
     * @param Formatter|array $formatter
     * @param string $logLevel
     * @return void
     *
     * @dataProvider providerForGetLogMessageFromListLogsByStatusLog
     */
    public function test_getLogMessageFromListLogsByStatusLog_withParameterStatusLogError_shouldReturnAllLogsWithStatus(
        Formatter|array $formatter,
        string $logLevel
    ): void {
        $arrFormatters = is_array($formatter) ? $formatter : [$formatter];
        $this->fakeConsoleLogger->addLogMessageInListLogsFake($arrFormatters);
        if (count($this->fakeConsoleLogger->getListLogsFake()) > 0) {
            $resLogs = $this->fakeConsoleLogger->getLogMessageFromListLogsByStatusLog($logLevel);
            if (count(array_diff($resLogs, $arrFormatters)) === 0) {
                $this->assertTrue(true);
            }
        }
        $this->assertTrue(false);
    }

    /**
     * @param Formatter|array $formatter
     * @param string $fromDataTime
     * @param string $toDataTime
     * @return void
     *
     * @dataProvider providerForGetLogMessageFromListLogsByDataTime
     */
    public function test_getLogMessageFromListLogsByDataTime_withParametersStartAndEndDateTime_shouldReturnAllLogsFromDatetimeInterval(
        Formatter|array $formatter,
        string $fromDataTime,
        string $toDataTime
    ): void {
        $arrFormatters = is_array($formatter) ? $formatter : [$formatter];
        $this->fakeConsoleLogger->addLogMessageInListLogsFake($arrFormatters);
        if (count($this->fakeConsoleLogger->getListLogsFake()) > 0) {
            $resLogs = $this->fakeConsoleLogger->getLogMessageFromListLogsByDataTime(
                $fromDataTime,
                $toDataTime
            );
            if (count(array_diff($resLogs, $arrFormatters)) === 0) {
                $this->assertTrue(true);
            }
        }
        $this->assertTrue(false);
    }

    /**
     * @param Formatter|array $formatter
     * @param string $message
     * @return void
     *
     * @dataProvider providerForGetLogMessageFromListLogsByMessage
     */
    public function test_getLogMessageFromListLogsByMessage_withParameterMessage_shouldReturnAllLoggersWithThisMessage(
        Formatter|array $formatter,
        string $message
    ): void {
        $arrFormatters = is_array($formatter) ? $formatter : [$formatter];
        $this->fakeConsoleLogger->addLogMessageInListLogsFake($arrFormatters);
        if (count($this->fakeConsoleLogger->getListLogsFake()) > 0) {
            $resLog = $this->fakeConsoleLogger->getLogMessageFromListLogsByMessage($message);
            if (array_search($resLog, $arrFormatters)) {
                $this->assertTrue(true);
            }
        }
        $this->assertTrue(false);
    }

    /**
     * @param string $logLevel
     *
     * @return void
     *
     * @dataProvider providerLogLevels
     */
    public function test_log_withMessageAndContext_shouldWriteAMessageToTheConsole(
        string $logLevel
    ): void {
        $this->fakeFormatter->setStatusLog($logLevel);
        $this->expectOutputString($this->fakeFormatter->generateMessageLog());
        $this->fakeConsoleLogger->log($logLevel, $this->fakeFormatter->getMessageLog());
    }

    public function providerLogLevels(): array
    {
        return [
            'LogLevel::ALERT'     => [LogLevel::ALERT],
            'LogLevel::CRITICAL'  => [LogLevel::CRITICAL],
            'LogLevel::DEBUG'     => [LogLevel::DEBUG],
            'LogLevel::EMERGENCY' => [LogLevel::EMERGENCY],
            'LogLevel::ERROR'     => [LogLevel::ERROR],
            'LogLevel::INFO'      => [LogLevel::INFO],
            'LogLevel::NOTICE'    => [LogLevel::NOTICE],
            'LogLevel::WARNING'   => [LogLevel::WARNING],
        ];
    }

    public function providerFormatters(): array
    {
        return [
            'formatter object' => [(new FakeFormatter())->setStatusLog(LogLevel::INFO)],
            'formatter array' => [
                (new FakeFormatter())
                    ->setStatusLog(LogLevel::INFO)
                    ->setIndexLog('00001')
                    ->setMessageLog('This is just the first test message.'),
                (new FakeFormatter())
                    ->setStatusLog(LogLevel::ERROR)
                    ->setIndexLog('00002')
                    ->setMessageLog('Its just a second test message.'),
                (new FakeFormatter())
                    ->setStatusLog(LogLevel::ERROR)
                    ->setIndexLog('00003')
                    ->setMessageLog('This is just the third test message.'),
            ],
        ];
    }

    public function providerForGetLogMessageFromListLogsById(): array
    {
        return [
            'test 1' => [
                [
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::INFO)
                        ->setIndexLog('00001')
                        ->setMessageLog('This is just the first test message.'),
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::ERROR)
                        ->setIndexLog('00002')
                        ->setMessageLog('Its just a second test message.'),
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::ERROR)
                        ->setIndexLog('00003')
                        ->setMessageLog('This is just the third test message.'),
                ],
                1
            ],
        ];
    }

    public function providerForGetLogMessageFromListLogsByIndex(): array
    {
        return [
            'test 1' => [
                [
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::INFO)
                        ->setIndexLog('00001')
                        ->setMessageLog('This is just the first test message.'),
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::ERROR)
                        ->setIndexLog('00002')
                        ->setMessageLog('Its just a second test message.'),
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::ERROR)
                        ->setIndexLog('00003')
                        ->setMessageLog('This is just the third test message.'),
                ],
                '00002'
            ],
        ];
    }

    public function providerForGetLogMessageFromListLogsByStatusLog(): array
    {
        return [
            'test 1' => [
                [
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::INFO)
                        ->setIndexLog('00001')
                        ->setMessageLog('This is just the first test message.'),
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::ERROR)
                        ->setIndexLog('00002')
                        ->setMessageLog('Its just a second test message.'),
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::ERROR)
                        ->setIndexLog('00003')
                        ->setMessageLog('This is just the third test message.'),
                ],
                LogLevel::ERROR
            ],
        ];
    }

    public function providerForGetLogMessageFromListLogsByDataTime(): array
    {
        return [
            'test 1' => [
                [
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::INFO)
                        ->setIndexLog('00001')
                        ->setMessageLog('This is just the first test message.')
                        ->setDateTime('2001-03-10 17:06:18'),
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::ERROR)
                        ->setIndexLog('00002')
                        ->setMessageLog('Its just a second test message.')
                        ->setDateTime('2001-03-12 17:16:18'),
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::ERROR)
                        ->setIndexLog('00003')
                        ->setMessageLog('Its just a 4 test message.')
                        ->setDateTime('2001-03-12 18:30:18'),
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::ERROR)
                        ->setIndexLog('00004')
                        ->setMessageLog('This is just the third test message.')
                        ->setDateTime('2001-03-12 19:10:08'),
                ],
                '2001-03-12 17:00:00',
                '2001-03-12 19:00:00',
            ],
        ];
    }

    public function providerForGetLogMessageFromListLogsByMessage(): array
    {
        return [
            'test 1' => [
                [
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::INFO)
                        ->setIndexLog('00001')
                        ->setMessageLog('This is just the first test message.'),
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::ERROR)
                        ->setIndexLog('00002')
                        ->setMessageLog('Its just a second test message.'),
                    (new FakeFormatter())
                        ->setStatusLog(LogLevel::ERROR)
                        ->setIndexLog('00003')
                        ->setMessageLog('This is just the third test message.'),
                ],
                'Its just a second test message.'
            ],
        ];
    }
}
