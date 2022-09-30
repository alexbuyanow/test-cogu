<?php

namespace App\Catalog\Filter;

use Symfony\Component\HttpFoundation\Request;

/**
 * Http фильтр по книгам
 */
class BookHttpFilter implements BookFilterInterface
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

    /**
     * Возвращает автора
     *
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->request->query->get('author', '');
    }

    /**
     * Возвращает жанр
     *
     * @return string
     */
    public function getGenre(): string
    {
        return $this->request->query->get('genre', '');
    }

    /**
     * Возвращает лимит
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->request->query->get('limit', 0);
    }

    /**
     * Возвращает оффсет
     *
     * @return int
     */
    public function getOffset(): int
    {
        return $this->request->query->get('offset', 0);
    }
}