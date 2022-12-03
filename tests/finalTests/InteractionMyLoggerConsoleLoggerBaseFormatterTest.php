<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\formattersTests;

use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;
use vadimcontenthunter\MyLogger\MyLogger;
use vadimcontenthunter\MyLogger\modules\ConsoleLogger;
use vadimcontenthunter\MyLogger\formatters\BaseFormatter;

class InteractionMyLoggerConsoleLoggerBaseFormatterTest extends TestCase
{
    public function test_alert_withMessage_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'The file was created successfully.';
        $status = LogLevel::ALERT;
        $this->expectOutputRegex('~^\[\d{5}]\s\[\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\]\s\[' . $status . ']\s' . $message . '$~u');

        $myLogger = new MyLogger(new ConsoleLogger(BaseFormatter::class));
        $myLogger->alert($message);
    }

    public function test_critical_withMessage_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'The file was created successfully.';
        $status = LogLevel::CRITICAL;
        $this->expectOutputRegex('~^\[\d{5}]\s\[\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\]\s\[' . $status . ']\s' . $message . '$~u');

        $myLogger = new MyLogger(new ConsoleLogger(BaseFormatter::class));
        $myLogger->critical($message);
    }

    public function test_debug_withMessage_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'The file was created successfully.';
        $status = LogLevel::DEBUG;
        $this->expectOutputRegex('~^\[\d{5}]\s\[\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\]\s\[' . $status . ']\s' . $message . '$~u');

        $myLogger = new MyLogger(new ConsoleLogger(BaseFormatter::class));
        $myLogger->debug($message);
    }

    public function test_emergency_withMessage_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'The file was created successfully.';
        $status = LogLevel::EMERGENCY;
        $this->expectOutputRegex('~^\[\d{5}]\s\[\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\]\s\[' . $status . ']\s' . $message . '$~u');

        $myLogger = new MyLogger(new ConsoleLogger(BaseFormatter::class));
        $myLogger->emergency($message);
    }

    public function test_error_withMessage_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'The file was created successfully.';
        $status = LogLevel::ERROR;
        $this->expectOutputRegex('~^\[\d{5}]\s\[\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\]\s\[' . $status . ']\s' . $message . '$~u');

        $myLogger = new MyLogger(new ConsoleLogger(BaseFormatter::class));
        $myLogger->error($message);
    }

    public function test_info_withMessage_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'The file was created successfully.';
        $status = LogLevel::INFO;
        $this->expectOutputRegex('~^\[\d{5}]\s\[\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\]\s\[' . $status . ']\s' . $message . '$~u');

        $myLogger = new MyLogger(new ConsoleLogger(BaseFormatter::class));
        $myLogger->info($message);
    }

    public function test_log_withMessage_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'The file was created successfully.';
        $status = LogLevel::ERROR;
        $this->expectOutputRegex('~^\[\d{5}]\s\[\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\]\s\[' . $status . ']\s' . $message . '$~u');

        $myLogger = new MyLogger(new ConsoleLogger(BaseFormatter::class));
        $myLogger->log($status, $message);
    }

    public function test_getLogMessageFromListLogsByStatusLog_withSixLogs_shouldReturnThreeInfoTwoErrorsOneDebug(): void
    {
        $consoleLogger = new ConsoleLogger(BaseFormatter::class);
        $myLogger = new MyLogger($consoleLogger);
        $myLogger->info('Test info 1');
        $myLogger->info('Test info 2');
        $myLogger->error('Test error 1');
        $myLogger->info('Test info 3');
        $myLogger->error('Test error 2');
        $myLogger->debug('Test debug 1');

        $errors = $consoleLogger->getLogMessageFromListLogsByStatusLog(LogLevel::ERROR);
        $info = $consoleLogger->getLogMessageFromListLogsByStatusLog(LogLevel::INFO);
        $debug = $consoleLogger->getLogMessageFromListLogsByStatusLog(LogLevel::DEBUG);

        if (
            count($errors) === 2
            && count($info) === 3
            && count($debug) === 1
        ) {
            $this->assertTrue(true);
            return;
        }

        $this->assertTrue(false);
    }
}
