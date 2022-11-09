<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\formattersTests;

use PHPUnit\Framework\TestCase;
use Psr\Log\InvalidArgumentException;
use vadimcontenthunter\MyLogger\formatters\BaseFormatter;

class BaseFormatterTest extends TestCase
{
    protected BaseFormatter $baseFormatter;

    public function setUp(): void
    {
        $this->baseFormatter = new BaseFormatter();
    }

    /**
     * Метод для проверки правильных кейсов
     *
     * @param string $message
     * @param array $context
     * @param mixed $expected
     * @return void
     *
     * @dataProvider providerWithRightMessageAndContext
     */
    public function test_getMessage_withTheRightMessageAndContext_shouldReturnAString(
        string $message,
        array $context,
        $expected
    ): void {
        $resultMessage = $this->baseFormatter->getMessage($message, $context);
        $this->assertEquals($expected, $resultMessage);
    }

    /**
     * Метод для проверки НЕКОРРЕКТНЫХ кейсов
     *
     * @param string $message
     * @param array $context
     * @return void
     *
     * @dataProvider providerWithWrongMessageOrContext
     */
    public function test_getMessage_withTheWrongMessageOrContext_shouldReturnAnException(
        string $message,
        array $context,
        \Exception $objException
    ): void {
        $this->expectException($objException::class);
        $this->baseFormatter->getMessage($message, $context);
    }

    public function providerWithRightMessageAndContext(): array
    {
        return [
            'Message without placeholders and parameter contexts' => [
                'The file was created successfully.',
                [],
                'The file was created successfully.'
            ],
            'Message without placeholders with parameter contexts' => [
                'The file was created successfully.',
                [
                    ['file_name' => 'new_file.txt'],
                    ['action' => 'created']
                ],
                'The file was created successfully.'
            ],
            'Message with placeholders and parameter contexts' => [
                'The file {file_name} was {action} successfully.',
                [
                    ['file_name' => 'new_file.txt'],
                    ['action' => 'created']
                ],
                'The file new_file.txt was created successfully.'
            ],
            'Message contains more parameter context than placeholders' => [
                'The file {file_name} was {action} successfully.',
                [
                    ['file_name' => 'new_file.txt'],
                    ['action' => 'created'],
                    ['user' => 'user001'],
                    ['date' => '05.11.2022'],
                ],
                'The file new_file.txt was created successfully.'
            ],
            'Message with right placeholders and parameter contexts' => [
                'The file {fileName} was {action1} successfully.',
                [
                    ['fileName' => 'new_file.txt'],
                    ['action1' => 'created']
                ],
                'The file new_file.txt was created successfully.'
            ],
        ];
    }

    public function providerWithWrongMessageOrContext(): array
    {
        return [
            'Message with placeholders without parameter contexts' => [
                'The file {name} was created successfully.',
                [],
                new InvalidArgumentException()
            ],
            'Message contains more placeholders than parameter contexts' => [
                'The file {file_name} was {action} successfully.',
                [
                    ['file_name' => 'new_file.txt'],
                ],
                new InvalidArgumentException()
            ],
            'invalid context parameter when messaged with placeholders and valid context parameters' => [
                'The file {file_name} was {action} successfully.',
                [
                    ['file_name' => 'new_file.txt'],
                    ['action' => 'created'],
                    ['sql' => [
                        'SELECT count(*) FROM tAuthors;',
                        'SELECT * FROM tAuthors WHERE AuthorFirstName="Александр";',
                    ]],
                ],
                new InvalidArgumentException()
            ],
            '#1 Message with wrong placeholder and with right parameter contexts' => [
                'The file file_name} was {action} successfully.',
                [
                    ['file_name' => 'new_file.txt'],
                ],
                new InvalidArgumentException()
            ],
            '#2 Message with wrong placeholder and with right parameter contexts' => [
                'The file {file_name was {action} successfully.',
                [
                    ['file_name' => 'new_file.txt'],
                    ['action' => 'created']
                ],
                new InvalidArgumentException()
            ],
            '#3 Message with wrong placeholder and with right parameter contexts' => [
                'The file { file_name} was {action} successfully.',
                [
                    ['file_name' => 'new_file.txt'],
                    ['action' => 'created']
                ],
                new InvalidArgumentException()
            ],
            '#4 Message with wrong placeholder and with right parameter contexts' => [
                'The file {file_name } was {action} successfully.',
                [
                    ['file_name' => 'new_file.txt'],
                    ['action' => 'created']
                ],
                new InvalidArgumentException()
            ],
            '#5 Message with wrong placeholder and with right parameter contexts' => [
                'The file { file_name } was {action} successfully.',
                [
                    ['file_name' => 'new_file.txt'],
                    ['action' => 'created']
                ],
                new InvalidArgumentException()
            ],
            '#6 Message with wrong placeholders and with right parameter contexts' => [
                'The file file_name} was { action} successfully.',
                [
                    ['file_name' => 'new_file.txt'],
                    ['action' => 'created']
                ],
                new InvalidArgumentException()
            ],
            '#7 Message with wrong placeholders and with right parameter contexts' => [
                'The file file_name} was {action successfully.',
                [
                    ['file_name' => 'new_file.txt'],
                    ['action' => 'created']
                ],
                new InvalidArgumentException()
            ],
            '#8 Message with wrong placeholder and with right parameter contexts' => [
                'The file {file,name} was {action} successfully.',
                [
                    ['file,name' => 'new_file.txt'],
                    ['action' => 'created']
                ],
                new InvalidArgumentException()
            ],
            '#9 Message with wrong placeholder and with right parameter contexts' => [
                'The file {file_name#1} was {action} successfully.',
                [
                    ['file_name#1' => 'new_file.txt'],
                    ['action' => 'created']
                ],
                new InvalidArgumentException()
            ],
            '#10 Message with wrong placeholder and with right parameter contexts' => [
                'The file {имя} was {action} successfully.',
                [
                    ['Имя' => 'new_file.txt'],
                    ['action' => 'created']
                ],
                new InvalidArgumentException()
            ]
        ];
    }
}
