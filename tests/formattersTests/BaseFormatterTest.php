<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\formattersTests;

use PHPUnit\Framework\TestCase;
use vadimcontenthunter\MyLogger\formatters\BaseFormatter;

class BaseFormatterTest extends TestCase
{
    protected BaseFormatter $baseFormatter;

    public function setUp(): void
    {
        $this->baseFormatter = new BaseFormatter();
    }

    /**
     * Тест аргументов метода, в виде обычного сообщения и без параметров для контекста.
     *
     * @return void
     */
    public function testNormalMessageWithoutParameterContexts()
    {
        $baseMessage = 'The file was created successfully.';
        $resultMessage = $this->baseFormatter->getMessage($baseMessage);
        $this->assertEquals($baseMessage, $resultMessage);
    }

    /**
     * Тест аргументов метода, в виде сообщения с заполнителями и без параметров для контекста.
     *
     * @return void
     */
    public function testMessageWithPlaceholdersWithoutParameterContexts()
    {
        $baseMessage = 'The file [{name}] was created successfully.';
        $resultMessage = $this->baseFormatter->getMessage($baseMessage);
        $this->assertEquals($baseMessage, $resultMessage);
    }

    /**
     * Тест аргументов метода, в виде обычного сообщения и с параметрами для контекста.
     *
     * @return void
     */
    public function testNormalMessageWithParameterContexts()
    {
        $baseMessage = 'The file was created successfully.';
        $baseParameters =   [
                                ['file_name' => 'new_file.txt'],
                                ['action' => 'created']
                            ];
        $resultMessage = $this->baseFormatter->getMessage($baseMessage, $baseParameters);
        $this->assertEquals($baseMessage, $resultMessage);
    }

    /**
     * Тест аргументов метода, в виде сообщения с заполнителями и с параметрами для контекста.
     *
     * @return void
     */
    public function testMessageWithPlaceholdersWithParameterContexts()
    {
        $baseMessage = 'The file [{file_name}] was {action} successfully.';
        $baseParameters =   [
                                ['file_name' => 'new_file.txt'],
                                ['action' => 'created']
                            ];
        $resultMessage = $this->baseFormatter->getMessage($baseMessage, $baseParameters);
        $this->assertEquals($baseMessage, $resultMessage);
    }
}
