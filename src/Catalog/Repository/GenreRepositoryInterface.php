<?php

namespace App\Catalog\Repository;

use App\Catalog\Entity\Genre;
use App\Catalog\Filter\GenreFilterInterface;

/**
 * Интерфейс репозитория жанров
 */
interface GenreRepositoryInterface
{
    /**
     * Возвращает список жанров
     *
     * @param GenreFilterInterface $filter
     *
     * @return Genre[]
     */
    public function getList(GenreFilterInterface $filter): array;

    /**
     * Сохраняет жанр
     *
     * @param Genre $genre
     */
    public function save(Genre $genre): void;

    /**
     * Удаляет жанр
     *
     * @param Genre $genre
     */
    public function remove(Genre $genre): void;

    /**
     * Используется ли жанр
     *
     * @param Genre $genre
     *
     * @return bool
     */
    public function isInUse(Genre $genre): bool;
}