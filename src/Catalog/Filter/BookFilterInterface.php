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
}