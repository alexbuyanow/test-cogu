<?php

namespace App\Catalog\Filter;

/**
 * Интерфейс фильтра по жанрам
 */
interface GenreFilterInterface
{
    /**
     * Возвращает название
     *
     * @return string
     */
    public function getName(): string;
}