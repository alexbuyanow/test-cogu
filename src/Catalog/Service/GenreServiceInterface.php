<?php

namespace App\Catalog\Service;

use App\Catalog\Entity\Genre;
use App\Catalog\Entity\GenreData;
use App\Catalog\Filter\GenreFilterInterface;

/**
 * Интерфейс сервиса жанров
 */
interface GenreServiceInterface
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
     * Создает жанр
     *
     * @param GenreData $genreData
     *
     * @return Genre
     */
    public function create(GenreData $genreData): Genre;

    /**
     * Изменяет жанр
     *
     * @param Genre     $genre
     * @param GenreData $data
     *
     * @return Genre
     */
    public function change(Genre $genre, GenreData $data): Genre;

    /**
     * Удаляет жанр
     *
     * @param Genre $genre
     */
    public function remove(Genre $genre): void;
}