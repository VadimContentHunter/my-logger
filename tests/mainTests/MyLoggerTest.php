<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\mainTests;

use Psr\Log\LogLevel;
use PHPUnit\Framework\TestCase;
use vadimcontenthunter\MyLogger\interfaces\Formatter;
use vadimcontenthunter\MyLogger\exceptions\NoLoggerException;
use vadimcontenthunter\MyLogger\Tests\src\fakes\MyLoggerFake;
use vadimcontenthunter\MyLogger\Tests\src\fakes\FakeFormatter;
use vadimcontenthunter\MyLogger\Tests\src\fakes\ModuleEchoFake;

class MyLoggerTest extends TestCase
{
    protected ModuleEchoFake $moduleEchoFake;

    protected MyLoggerFake $myLoggerFake;

    public function setUp(): void
    {
        $this->moduleEchoFake = new ModuleEchoFake(FakeFormatter::class);
        $this->myLoggerFake = new MyLoggerFake($this->moduleEchoFake);
    }

    public function test_emergency_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'Calling the emergency method!';
        $regex = '~^.*Calling the emergency method!.*$~u';
        $this->expectOutputRegex($regex);
        $this->myLoggerFake->emergency($message, []);
    }

    public function test_alert_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'Calling the alert method!';
        $regex = '~^.*Calling the alert method!.*$~u';
        $this->expectOutputRegex($regex);
        $this->myLoggerFake->alert($message, []);
    }

    public function test_critical_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'Calling the critical method!';
        $regex = '~^.*Calling the critical method!.*$~u';
        $this->expectOutputRegex($regex);
        $this->myLoggerFake->critical($message, []);
    }

    public function test_error_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'Calling the error method!';
        $regex = '~^.*Calling the error method!.*$~u';
        $this->expectOutputRegex($regex);
        $this->myLoggerFake->error($message, []);
    }

    public function test_warning_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'Calling the warning method!';
        $regex = '~^.*Calling the warning method!.*$~u';
        $this->expectOutputRegex($regex);
        $this->myLoggerFake->warning($message, []);
    }

    public function test_notice_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'Calling the notice method!';
        $regex = '~^.*Calling the notice method!.*$~u';
        $this->expectOutputRegex($regex);
        $this->myLoggerFake->notice($message, []);
    }

    public function test_info_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'Calling the info method!';
        $regex = '~^.*Calling the info method!.*$~u';
        $this->expectOutputRegex($regex);
        $this->myLoggerFake->info($message, []);
    }

    public function test_debug_withMessageAndContext_shouldWriteAMessageToTheConsole(): void
    {
        $message = 'Calling the debug method!';
        $regex = '~^.*Calling the debug method!.*$~u';
        $this->expectOutputRegex($regex);
        $this->myLoggerFake->debug($message, []);
    }

    public function test_execute_withCallbackFunction_shouldWriteAMessageToTheConsole(): void
    {
        $param = 'test';
        $this->expectOutputString('This is a special method! $param: ' . $param);
        $this->myLoggerFake->execute(function ($logger) use ($param) {
            if ($logger instanceof ModuleEchoFake) {
                $logger->specialMethod($param);
            } else {
                throw new \Exception("Error logger does not conform to ModuleEchoFake interface");
            }
        });
    }

    public function test_checkLoggers_withoutParameters_shouldReturnAnException(): void
    {
        $this->expectException(NoLoggerException::class);
        $this->myLoggerFake->fakeAddToListLoggers(['test word', (new FakeFormatter())]);
        $this->myLoggerFake->fakeCheckLoggers();
    }
}
