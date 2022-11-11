<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\formattersTests;

use PHPUnit\Framework\TestCase;
use Psr\Log\InvalidArgumentException;
use vadimcontenthunter\MyLogger\formatters\BaseFormatter;
use vadimcontenthunter\MyLogger\Tests\src\ProviderBaseFormatter;

class BaseFormatterTest extends TestCase
{
    protected BaseFormatter $baseFormatter;

    public function setUp(): void
    {
        $this->baseFormatter = new BaseFormatter();
    }

    /**
     * Проверки правильных кейсов для метода getMessageLog
     *
     * @param string $message
     * @param array $context
     * @param mixed $expected
     * @return void
     *
     * @dataProvider providerWithRightMessageAndContext
     */
    public function test_getMessageLog_withTheRightMessageAndContext_shouldReturnAString(
        string $message,
        array $context,
        $expected
    ): void {
        $resultMessage = $this->baseFormatter->getMessageLog($message, $context);
        $this->assertEquals($expected, $resultMessage);
    }

    /**
     * Проверки НЕКОРРЕКТНЫХ кейсов для метода getMessageLog
     *
     * @param string $message
     * @param array $context
     * @return void
     *
     * @dataProvider providerWithWrongMessageOrContext
     */
    public function test_getMessageLog_withTheWrongMessageOrContext_shouldReturnAnException(
        string $message,
        array $context,
        \Exception $objException
    ): void {
        $this->expectException($objException::class);
        $this->baseFormatter->getMessageLog($message, $context);
    }

    public function providerWithRightMessageAndContext(): array
    {
        return ProviderBaseFormatter::RIGHT_MESSAGE_AND_CONTEXT;
    }

    public function providerWithWrongMessageOrContext(): array
    {
        return ProviderBaseFormatter::WRONG_MESSAGE_OR_CONTEXT;
    }
}
