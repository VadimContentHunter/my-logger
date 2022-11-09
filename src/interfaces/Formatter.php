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
     * Метод возвращает отформатированную строку
     *
     * @param  \Stringable|string $message Входная строка, которая будет отформатирована.
     * @param  array              $context Контекст данных для заполнителей.
     * @return string
     */
    public function getMessage(\Stringable|string $message, array $context = []): string;
}
