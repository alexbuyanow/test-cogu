<?php

namespace App\Catalog\Filter;

use Symfony\Component\HttpFoundation\Request;

use DateTimeInterface;

/**
 * Http фильтр по авторам
 */
class AuthorHttpFilter implements AuthorFilterInterface
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