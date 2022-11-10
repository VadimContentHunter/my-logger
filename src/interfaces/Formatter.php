<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\interfaces;

use Psr\Log\LogLevel;

/**
 * Данный интерфейс должны реализовывать все классы, которые будут заниматься форматированием сообщения.
 *
 * @package   MyLogger_Interfaces
 * @author    Vadim Volkovskyi <project.k.vadim@gmail.com>
 * @copyright (c) Vadim Volkovskyi 2022
 */
interface Formatter
{
    /**
     * Метод возвращает отформатированное сообщение
     *
     * @param  \Stringable|string $message Входная строка, которая будет отформатирована.
     * @param  array              $context Контекст данных для заполнителей.
     * @return string
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function getMessageLog(\Stringable|string $message, array $context = []): string;

    /**
     * Возвращает уникальный индекс лога
     *
     * @return string
     */
    public function getIndexLog(): string;

    /**
     * Возвращает уровень лога
     *
     * @return LogLevel
     */
    public function getStatusLog(): LogLevel;

    /**
     * Возвращает дату и время фиксации лога
     *
     * @return string
     */
    public function getDataTime(): string;

    /**
     * Возвращает сгенерированную строку для лога
     *
     * @return string
     */
    public function generateMessageLog(): string;
}
