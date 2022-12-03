<?php

declare(strict_types=1);

namespace vadimcontenthunter\MyLogger\interfaces;

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
      * Устанавливает индекс для лога
      *
      * @param array $indexes Существующие индексы. Нужны для генерации индекса не похожего на один из этого списка.
      *                       Индексы формируются по порядку возрастания и заполняют пропущенные индексы в том же порядке.
      *
      * @return mixed
      */
    public function setIndexLog(array $indexes): mixed;

    /**
     * Устанавливает статус для лога
     *
     * @param string $statusLog Статус для лога
     *
     * @return mixed
     */
    public function setStatusLog(string $statusLog): mixed;

    /**
     * Метод устанавливает значение для сообщения
     *
     * @param \Stringable|string $message
     * @param array $context
     *
     * @return mixed
     */
    public function setMessageLog(\Stringable|string $message, array $context = array()): mixed;

    /**
     * Метод возвращает отформатированное сообщение
     *
     * @return string
     */
    public function getMessageLog(): string;

    /**
     * Возвращает уникальный индекс лога
     *
     * @return string
     */
    public function getIndexLog(): string;

    /**
     * Возвращает уровень лога
     *
     * @return string
     */
    public function getStatusLog(): string;

    /**
     * Возвращает дату и время фиксации лога
     *
     * @return string
     */
    public function getDateTime(): string;

    /**
     * Возвращает сгенерированную строку для лога
     *
     * @return string
     */
    public function generateMessageLog(): string;

    /**
     * Проверка правильности сгенерированного сообщения
     *
     * @param string $message Сообщение для проверки
     *
     * @return bool Возвращает true, в случае если сгенерированное сообщение соответствует формату иначе false.
     */
    public function checkGenerateMessage(string $message): bool;
}
