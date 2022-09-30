<?php

namespace App\Catalog\Filter;

/**
 * Интерфейс фильтра книг
 */
interface BookFilterInterface
{
    /**
     * Возвращает название
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Возвращает автора
     *
     * @return string
     */
    public function getAuthor(): string;

    /**
     * Возвращает жанр
     *
     * @return string
     */
    public function getGenre(): string;

    /**
     * Возвращает лимит
     *
     * @return int
     */
    public function getLimit(): int;

    /**
     * Возвращает оффсет
     *
     * @return int
     */
    public function getOffset(): int;
}