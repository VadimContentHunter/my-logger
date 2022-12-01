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
        $this->baseFormatter = new BaseFormatter();
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
     * Тест на проверку метода setIndexLog
     *
     * @return void
     *
     * @dataProvider providerWithIndexes
     */
    public function test_setIndexLog_withDifferentData_shouldReturnSequenceOfNumbersInAString(array $_indexes, string $expected): void
    {
        $resultIndexLog = $this->baseFormatter->setIndexLog($_indexes)->getIndexLog();
        $this->assertEquals($expected, $resultIndexLog);
    }

    /**
     * Проверки правильных кейсов для метода setStatusLog
     *
     * @param string $_statusLog    Статус лога
     * @param string $expected      Ожидаемый статус лога
     *
     * @return void
     *
     * @dataProvider providerWithRightStatusLog
     */
    public function test_setStatusLog_withTheRightStatusLog_shouldReturnALogLevelString(string $_statusLog, string $expected): void
    {
        $resultStatusLog = $this->baseFormatter->setStatusLog($_statusLog)->getStatusLog();
        $this->assertEquals($expected, $resultStatusLog);
    }

    /**
     * Проверки НЕКОРРЕКТНЫХ кейсов для метода setStatusLog, который должны вызывать исключение
     *
     * @param string $_statusLog        Статус лога
     * @param \Exception $objException  Объект исключения который должен появляться у метода
     *
     * @return void
     *
     * @dataProvider providerWithWrongStatusLog
     */
    public function test_setStatusLog_withTheWrongStatusLog_shouldReturnAnException(
        string $_statusLog,
        \Exception $objException
    ): void {
        $this->expectException($objException::class);
        $this->baseFormatter->setStatusLog($_statusLog);
    }

    /**
     * Тест метода setDataTime
     *
     * @return void
     */
    public function test_setDataTime_withoutParameters_shouldReturnTheDateAndTimeAsAString(): void
    {
        $resultDataTime = $this->baseFormatter->setDataTime()->getDataTime();
        $date = date("Y-m-d");

        if (
            preg_match(
                '~(?<date>^\d{4}-\d{2}-\d{2})(?<time>\s(?<hour>\d{2}):(?<minute>\d{2}):(?<second>\d{2}))?$~iu',
                $resultDataTime,
                $matches
            )
        ) {
            if (!isset($matches['time'])) {
                $this->assertEquals($date, $resultDataTime);
            } elseif (
                isset($matches['date'], $matches['time'], $matches['hour'], $matches['minute'], $matches['second']) &&
                strcasecmp($matches['date'], $date) === 0
            ) {
                $this->assertTrue(true);
            }
        }

        $this->assertTrue(false);
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
        return ProviderBaseFormatter::rightMessageAndContext();
    }

    public function providerWithWrongMessageOrContext(): array
    {
        return ProviderBaseFormatter::wrongMessageOrContext();
    }

    public function providerWithIndexes(): array
    {
        return ProviderBaseFormatter::indexes();
    }

    public function providerWithRightStatusLog(): array
    {
        return ProviderBaseFormatter::rightStatusLog();
    }

    public function providerWithWrongStatusLog(): array
    {
        return ProviderBaseFormatter::wrongStatusLog();
    }
}
