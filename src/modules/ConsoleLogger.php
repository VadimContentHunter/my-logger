<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\modules;

use Psr\Log\LoggerInterface;
use vadimcontenthunter\MyLogger\exceptions\NoFormatterException;
use vadimcontenthunter\MyLogger\interfaces\Formatter;

/**
 * Логгер фиксирует события в консоль
 *
 * @package   MyLogger_Modules
 * @author    Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
class ConsoleLogger implements LoggerInterface
{
    /**
     * Хранит все зафиксированные логи
     *
     * @var array
     */
    protected array $listLogs = [];

    /**
     * Выполнять сохранения всех логов.
     * - true - Да;
     * - false - Нет;
     *
     * @var bool
     */
    protected bool $saveToLogList = true;

    protected string $formatterClass;

    /**
     * Initializes the ConsoleLogger
     *
     * @param string $_formatterClass название класса форматера
     * @param bool $_saveToLogList  - true - Сохранять все логи;
     *                              - false - НЕ сохранять логи
     */
    public function __construct(string $_formatterClass, bool $_saveToLogList = true)
    {
        $this->listLogs = [];
        $this->saveToLogList = $_saveToLogList;
        $this->formatterClass = $this->getFormatterClass($_formatterClass);
    }

    /**
     * Проверяет название класса на корректность и возвращает название класса
     *
     * @param string $_formatterClass название класса форматера
     *
     * @throws NoFormatterException
     *
     * @return string
     */
    public function getFormatterClass(string $_formatterClass): string
    {
        return '';
    }

    /**
     * Выводит сообщение лога по его идентификатор из списка сохраненных логов. (listLogs[id])
     *
     * Параметр "saveToLogList" должен быть true
     *
     * @param int $id Уникальный идентификатор лога
     *
     * @return string
     */
    public function getLogMessageFromListLogsById(int $id): string
    {
        return '';
    }

    /**
     * Выводит сообщение лога по его уникальному индексу из списка сохраненных логов
     *
     * Параметр "saveToLogList" должен быть true
     *
     * @param string $index Уникальный индекс лога
     *
     * @return string
     */
    public function getLogMessageFromListLogsByIndex(string $index): string
    {
        return '';
    }

    /**
     * Выводит сообщения логов по их статусу из списка сохраненных логов
     *
     * Параметр "saveToLogList" должен быть true
     *
     * @param string $statusLog Статус логов, которые нужно вывести
     *
     * @return array<string>
     */
    public function getLogMessageFromListLogsByStatusLog(string $statusLog): array
    {
        return [];
    }

     /**
      * Выводит сообщения логов по их статусу из списка сохраненных логов
      *
      * Параметр "saveToLogList" должен быть true;
      *
      * @param string $fromDataTime От какой даты и времени (включительно); Формат:
      *                             - 2001-03-10 17:16:18;
      *                             - 2001-03-10;
      *                             - 17:16:18;
      * @param string $toDataTime   До какой даты и времени (включительно); Формат:
      *                             - 2001-03-10 17:16:18;
      *                             - 2001-03-10;
      *                             - 17:16:18;
      *
      * @return array<string>
      */
    public function getLogMessageFromListLogsByDataTime(string $fromDataTime, string $toDataTime): array
    {
        return [];
    }

    /**
     * Выводит сообщения логов по их сообщению, описанию логов из списка сохраненных логов
     *
     * Параметр "saveToLogList" должен быть true
     *
     * @param string $message Описание лога
     *
     * @return array<string>
     */
    public function getLogMessageFromListLogsByMessage(string $message): array
    {
        return [];
    }

    /**
     * Добавляет объект форматера в список логов
     *
     * Параметр "saveToLogList" должен быть true
     *
     * @param Formatter|array<Formatter> $formatter форматер с параметрами для сообщения. Или массив форматеров.
     *
     * @return void
     */
    protected function addLogMessageInListLogs(Formatter|array $formatter): void
    {
    }

    /**
     * System is unusable.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function emergency(string|\Stringable $message, array $context = []): void
    {
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function alert(string|\Stringable $message, array $context = []): void
    {
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function critical(string|\Stringable $message, array $context = []): void
    {
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function error(string|\Stringable $message, array $context = []): void
    {
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function warning(string|\Stringable $message, array $context = []): void
    {
    }

    /**
     * Normal but significant events.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function notice(string|\Stringable $message, array $context = []): void
    {
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function info(string|\Stringable $message, array $context = []): void
    {
    }

    /**
     * Detailed debug information.
     *
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function debug(string|\Stringable $message, array $context = []): void
    {
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed   $level
     * @param string|\Stringable $message
     * @param mixed[] $context
     *
     * @return void
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function log($level, string|\Stringable $message, array $context = []): void
    {
    }
}