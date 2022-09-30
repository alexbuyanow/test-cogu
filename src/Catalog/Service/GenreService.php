<?php

namespace App\Catalog\Service;

use App\Catalog\Entity\Genre;
use App\Catalog\Entity\GenreData;
use App\Catalog\Filter\GenreFilterInterface;

class GenreService implements GenreServiceInterface
{
    /**
     * Возвращает список жанров
     *
     * @param GenreFilterInterface $filter
     *
     * @return Genre[]
     */
    public function getList(GenreFilterInterface $filter): array
    {
        return [];
    }

    /**
     * Создает жанр
     *
     * @param GenreData $genre
     *
     * @return Genre
     */
    public function create(GenreData $genre): Genre
    {
        return new Genre(new GenreData(''));
    }

    /**
     * Изменяет жанр
     *
     * @param Genre     $genre
     * @param GenreData $data
     *
     * @return Genre
     */
    public function change(Genre $genre, GenreData $data): Genre
    {
        return new Genre(new GenreData(''));
    }

    /**
     * Удаляет жанр
     *
     * @param Genre $genre
     */
    public function remove(Genre $genre): void
    {

    }
}