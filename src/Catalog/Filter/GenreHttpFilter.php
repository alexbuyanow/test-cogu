<?php

namespace App\Catalog\Filter;

use Symfony\Component\HttpFoundation\Request;

/**
 * Http фильтр по жанрам
 */
class GenreHttpFilter implements GenreFilterInterface
{
    public function __construct(private readonly Request $request)
    {
    }

    /**
     * Возвращает название
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->request->query->get('name', '');
    }
}