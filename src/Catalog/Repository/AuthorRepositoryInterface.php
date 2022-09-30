<?php

namespace App\Catalog\Repository;

use App\Catalog\Entity\Author;
use App\Catalog\Filter\AuthorFilterInterface;

/**
 * Интерфейс репозитория авторов
 */
interface AuthorRepositoryInterface
{
    /**
     * Возвращает список авторов
     *
     * @param AuthorFilterInterface $filter
     *
     * @return Author[]
     */
    public function getList(AuthorFilterInterface $filter): array;

    /**
     * Сохраняет автора
     *
     * @param Author $author
     */
    public function save(Author $author): void;

    /**
     * Удаляет автора
     *
     * @param Author $author
     */
    public function remove(Author $author): void;

    /**
     * Используется ли автор
     *
     * @param Author $author
     *
     * @return bool
     */
    public function isInUse(Author $author): bool;
}