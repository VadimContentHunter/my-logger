<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\formattersTests;

use PHPUnit\Framework\TestCase;
// use Psr\Log\InvalidArgumentException;

use Psr\Log\LogLevel;
use vadimcontenthunter\MyLogger\formatters\BaseFormatter;
use vadimcontenthunter\MyLogger\Tests\src\fakes\FakeBaseFormatter;
use vadimcontenthunter\MyLogger\Tests\src\providers\ProviderBaseFormatter;

class BaseFormatterTest extends TestCase
{
    protected BaseFormatter $baseFormatter;

    public function setUp(): void
    {
        $statusLog = '';
        $message = '';
        $context = [];
        $this->baseFormatter = new BaseFormatter($statusLog, $message, $context);
    }

    /**
     * Тест на проверку метода getMessageLog
     *
     * @return void
     */
    public function test_getMessageLog_withoutParameters_shouldReturnAString(): void
    {
        $expected = 'The file was created successfully.';
        $message = 'The file was created successfully.';
        $fakeBaseFormatter = new FakeBaseFormatter();
        $fakeBaseFormatter->setMessageLogFake($message);
        $resultMessage = $fakeBaseFormatter->getMessageLog();
        $this->assertEquals($expected, $resultMessage);
    }

    /**
     * Тест на проверку метода getIndexLog
     *
     * @return void
     */
    public function test_getIndexLog_withoutParameters_shouldReturnTheIndexAsAString(): void
    {
        $expected = '00005';
        $index = '00005';
        $fakeBaseFormatter = new FakeBaseFormatter();
        $fakeBaseFormatter->setIndexLogFake($index);
        $resultMessage = $fakeBaseFormatter->getIndexLog();
        $this->assertEquals($expected, $resultMessage);
    }

    /**
     * Тест на проверку метода getStatusLog
     *
     * @return void
     */
    public function test_getStatusLog_withoutParameters_shouldReturnTheStatusAsAString(): void
    {
        $expected = LogLevel::ALERT;
        $status = LogLevel::ALERT;
        $fakeBaseFormatter = new FakeBaseFormatter();
        $fakeBaseFormatter->setStatusLogFake($status);
        $resultMessage = $fakeBaseFormatter->getStatusLog();
        $this->assertEquals($expected, $resultMessage);
    }

    /**
     * Тест на проверку метода getDataTime
     *
     * @return void
     */
    public function test_getDataTime_withoutParameters_shouldReturnTheDateAndTimeAsAString(): void
    {
        $expected = '2022-03-10 17:16:18';
        $message = '2022-03-10 17:16:18';
        $fakeBaseFormatter = new FakeBaseFormatter();
        $fakeBaseFormatter->setDataTimeFake($message);
        $resultMessage = $fakeBaseFormatter->getDataTime();
        $this->assertEquals($expected, $resultMessage);
    }

    /**
     * Проверки правильных кейсов для метода setMessageLog
     *
     * @param string $message   Сообщение лога
     * @param array $context    Контекст параметров
     * @param mixed $expected   Ожидаемый вид отформатировано строки
     *
     * @return void
     *
     * @dataProvider providerWithRightMessageAndContext
     */
    public function test_setMessageLog_withTheRightMessageAndContext_shouldReturnAString(
        string $message,
        array $context,
        $expected
    ): void {
        $this->baseFormatter->setMessageLog($message, $context);
        $resultMessage = $this->baseFormatter->getMessageLog();
        $this->assertEquals($expected, $resultMessage);
    }

    /**
     * Проверки НЕКОРРЕКТНЫХ кейсов для метода setMessageLog, который должны вызывать исключение
     *
     * @param string $message           Сообщение лога
     * @param array $context            Контекст параметров
     * @param \Exception $objException  Объект исключения который должен появляться у метода
     *
     * @return void
     *
     * @dataProvider providerWithWrongMessageOrContext
     */
    public function test_setMessageLog_withTheWrongMessageOrContext_shouldReturnAnException(
        string $message,
        array $context,
        \Exception $objException
    ): void {
        $this->expectException($objException::class);
        $this->baseFormatter->setMessageLog($message, $context);
        $this->baseFormatter->getMessageLog();
    }

    public function providerWithRightMessageAndContext(): array
    {
        return ProviderBaseFormatter::RightMessageAndContext();
    }

    public function providerWithWrongMessageOrContext(): array
    {
        return ProviderBaseFormatter::WrongMessageOrContext();
    }
}
