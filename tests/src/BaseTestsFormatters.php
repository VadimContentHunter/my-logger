<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\src;

use PHPUnit\Framework\TestCase;
use vadimcontenthunter\MyLogger\interfaces\Formatter;
use vadimcontenthunter\MyLogger\exceptions\MyLoggerException;

class BaseTestsFormatters extends TestCase
{
    protected ?Formatter $baseFormatter = null;

    /**
     * Тест метода, с аргументами в виде обычного сообщения и без параметров для контекста.
     *
     * @return void
     */
    public function testMessageWithoutPlaceholdersAndParameterContexts()
    {
        $expectedResult = 'The file was created successfully.';
        $baseMessage = 'The file was created successfully.';
        $resultMessage = $this->baseFormatter->getMessage($baseMessage);
        $this->assertEquals($expectedResult, $resultMessage);
    }

    /**
     * Тест метода, с аргументами в виде сообщения с заполнителями и без параметров для контекста.
     *
     * @return void
     */
    public function testMessageWithPlaceholdersWithoutParameterContexts()
    {
        $baseMessage = 'The file {name} was created successfully.';
        $this->expectException(MyLoggerException::class);
        $this->baseFormatter->getMessage($baseMessage);
    }

    /**
     * Тест метода, с аргументами в виде обычного сообщения и с параметрами для контекста.
     *
     * @return void
     */
    public function testMessageWithoutPlaceholdersWithParameterContexts()
    {
        $expectedResult = 'The file was created successfully.';
        $baseMessage = 'The file was created successfully.';
        $baseParameters =   [
                                ['file_name' => 'new_file.txt'],
                                ['action' => 'created']
                            ];
        $resultMessage = $this->baseFormatter->getMessage($baseMessage, $baseParameters);
        $this->assertEquals($expectedResult, $resultMessage);
    }

    /**
     * Тест метода, с аргументами в виде сообщения с заполнителями и с параметрами для контекста.
     *
     * @return void
     */
    public function testMessageWithPlaceholdersAndParameterContexts()
    {
        $expectedResult = 'The file new_file.txt was created successfully.';
        $baseMessage = 'The file {file_name} was {action} successfully.';
        $baseParameters =   [
                                ['file_name' => 'new_file.txt'],
                                ['action' => 'created']
                            ];
        $resultMessage = $this->baseFormatter->getMessage($baseMessage, $baseParameters);
        $this->assertEquals($expectedResult, $resultMessage);
    }

    /**
     * Тест метода, с аргументами в виде сообщения с заполнителями,которых БОЛЬШЕ чем параметров для контекста.
     *
     * @return void
     */
    public function testMessageContainsMorePlaceholdersThanParameterContexts()
    {
        $expectedResult = 'The file new_file.txt was created successfully.';
        $baseMessage = 'The file {file_name} was {action} successfully.';
        $baseParameters =   [
                                ['file_name' => 'new_file.txt'],
                            ];
        $resultMessage = $this->baseFormatter->getMessage($baseMessage, $baseParameters);
        $this->assertEquals($expectedResult, $resultMessage);
    }

    /**
     * Тест метода, с аргументами в виде сообщения с заполнителями,которых МЕНЬШЕ чем параметров для контекста.
     *
     * @return void
     */
    public function testMessageContainsMoreParameterContextsThanPlaceholders()
    {
        $expectedResult = 'The file new_file.txt was created successfully.';
        $baseMessage = 'The file {file_name} was {action} successfully.';
        $baseParameters =   [
                                ['file_name' => 'new_file.txt'],
                                ['action' => 'created'],
                                ['user' => 'user001'],
                                ['date' => '05.11.2022'],
                            ];
        $resultMessage = $this->baseFormatter->getMessage($baseMessage, $baseParameters);
        $this->assertEquals($expectedResult, $resultMessage);
    }
}
