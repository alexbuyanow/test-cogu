<?php

namespace App\Catalog\Filter;

/**
 * Интерфейс фильтра по авторам
 */
interface AuthorFilterInterface
{
    /**
     * Возвращает название
     *
     * @return string
     */
    public function getName(): string;
}