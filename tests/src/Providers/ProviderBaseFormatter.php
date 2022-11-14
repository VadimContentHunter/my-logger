<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\Tests\src\providers;

use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel;

class ProviderBaseFormatter
{
    public static function rightMessageAndContext(): array
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
                    'file_name' => 'new_file.txt',
                    'action' => 'created'
                ],
                'The file was created successfully.'
            ],
            'Message with placeholders and parameter contexts' => [
                'The file {file_name} was {action} successfully.',
                [
                    'file_name' => 'new_file.txt',
                    'action' => 'created'
                ],
                'The file new_file.txt was created successfully.'
            ],
            'Message contains more parameter context than placeholders' => [
                'The file {file_name} was {action} successfully.',
                [
                    'file_name' => 'new_file.txt',
                    'action' => 'created',
                    'user' => 'user001',
                    'date' => '05.11.2022',
                ],
                'The file new_file.txt was created successfully.'
            ],
            'Message with right placeholders and parameter contexts' => [
                'The file {fileName} was {action1} successfully.',
                [
                    'fileName' => 'new_file.txt',
                    'action1' => 'created'
                ],
                'The file new_file.txt was created successfully.'
            ],
        ];
    }

    public static function wrongMessageOrContext(): array
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
                    'file_name' => 'new_file.txt',
                ],
                new InvalidArgumentException()
            ],
            'invalid context parameter when messaged with placeholders and valid context parameters' => [
                'The file {file_name} was {action} successfully.',
                [
                    'file_name' => 'new_file.txt',
                    'action' => 'created',
                    'sql' => [
                        'SELECT count(*) FROM tAuthors;',
                        'SELECT * FROM tAuthors WHERE AuthorFirstName="Александр";',
                    ],
                ],
                new InvalidArgumentException()
            ],
            '#1 Message with wrong placeholder and with right parameter contexts' => [
                'The file file_name} was {action} successfully.',
                [
                    'file_name' => 'new_file.txt',
                ],
                new InvalidArgumentException()
            ],
            '#2 Message with wrong placeholder and with right parameter contexts' => [
                'The file {file_name was {action} successfully.',
                [
                    'file_name' => 'new_file.txt',
                    'action' => 'created'
                ],
                new InvalidArgumentException()
            ],
            '#3 Message with wrong placeholder and with right parameter contexts' => [
                'The file { file_name} was {action} successfully.',
                [
                    'file_name' => 'new_file.txt',
                    'action' => 'created'
                ],
                new InvalidArgumentException()
            ],
            '#4 Message with wrong placeholder and with right parameter contexts' => [
                'The file {file_name } was {action} successfully.',
                [
                    'file_name' => 'new_file.txt',
                    'action' => 'created'
                ],
                new InvalidArgumentException()
            ],
            '#5 Message with wrong placeholder and with right parameter contexts' => [
                'The file { file_name } was {action} successfully.',
                [
                    'file_name' => 'new_file.txt',
                    'action' => 'created'
                ],
                new InvalidArgumentException()
            ],
            '#6 Message with wrong placeholders and with right parameter contexts' => [
                'The file file_name} was { action} successfully.',
                [
                    'file_name' => 'new_file.txt',
                    'action' => 'created'
                ],
                new InvalidArgumentException()
            ],
            '#7 Message with wrong placeholders and with right parameter contexts' => [
                'The file file_name} was {action successfully.',
                [
                    'file_name' => 'new_file.txt',
                    'action' => 'created'
                ],
                new InvalidArgumentException()
            ],
            '#8 Message with wrong placeholder and with right parameter contexts' => [
                'The file {file,name} was {action} successfully.',
                [
                    'file,name' => 'new_file.txt',
                    'action' => 'created'
                ],
                new InvalidArgumentException()
            ],
            '#9 Message with wrong placeholder and with right parameter contexts' => [
                'The file {file_name#1} was {action} successfully.',
                [
                    'file_name#1' => 'new_file.txt',
                    'action' => 'created'
                ],
                new InvalidArgumentException()
            ],
            '#10 Message with wrong placeholder and with right parameter contexts' => [
                'The file {имя} was {action} successfully.',
                [
                    'Имя' => 'new_file.txt',
                    'action' => 'created'
                ],
                new InvalidArgumentException()
            ]
        ];
    }

    public static function indexes(): array
    {
        return [
            'Empty' => [
                [],
                '00001'
            ],
            'Correct indexes' => [
                [
                    '00001',
                    '00002',
                    '00003',
                ],
                '00004'
            ],
            'Incorrect' => [
                [
                    'message',
                    'next',
                    'Indexes',
                ],
                '00001'
            ],
            'Mixed' => [
                [
                    '00001',
                    'next',
                    '00002',
                    'Indexes',
                ],
                '00003'
            ],
            'Out of order' => [
                [
                    '00001',
                    '00003',
                    '00002',
                    '00005',
                ],
                '00004'
            ],
        ];
    }

    public static function rightStatusLog(): array
    {
        return [
            'LogLevel::ALERT' => [
                LogLevel::ALERT,
                LogLevel::ALERT,
            ],
            'LogLevel::CRITICAL' => [
                LogLevel::CRITICAL,
                LogLevel::CRITICAL,
            ],
            'LogLevel::DEBUG' => [
                LogLevel::DEBUG,
                LogLevel::DEBUG,
            ],
            'LogLevel::EMERGENCY' => [
                LogLevel::EMERGENCY,
                LogLevel::EMERGENCY,
            ],
            'LogLevel::ERROR' => [
                LogLevel::ERROR,
                LogLevel::ERROR,
            ],
            'LogLevel::INFO' => [
                LogLevel::INFO,
                LogLevel::INFO,
            ],
            'LogLevel::NOTICE' => [
                LogLevel::NOTICE,
                LogLevel::NOTICE,
            ],
            'LogLevel::WARNING' => [
                LogLevel::WARNING,
                LogLevel::WARNING,
            ],
        ];
    }

    public static function wrongStatusLog(): array
    {
        return [
            'LogLevel::ALERT' => [
                'test',
                new InvalidArgumentException(),
            ],
            'LogLevel::CRITICAL' => [
                '111',
                new InvalidArgumentException(),
            ],
            'LogLevel::DEBUG' => [
                '',
                new InvalidArgumentException(),
            ],
        ];
    }
}
