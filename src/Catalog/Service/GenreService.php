<?php

namespace App\Catalog\Service;

use App\Catalog\Entity\Genre;
use App\Catalog\Entity\GenreData;
use App\Catalog\Filter\GenreFilterInterface;
use App\Catalog\Repository\GenreRepositoryInterface;

/**
 * Сервис жанров
 */
class GenreService implements GenreServiceInterface
{
    /**
     * Конструктор
     *
     * @param GenreRepositoryInterface $genreRepository
     */
    public function __construct(private readonly GenreRepositoryInterface $genreRepository)
    {
    }

    /**
     * Возвращает список жанров
     *
     * @param GenreFilterInterface $filter
     *
     * @return Genre[]
     */
    public function getList(GenreFilterInterface $filter): array
    {
        return $this->genreRepository->getList($filter);
    }

    /**
     * Создает жанр
     *
     * @param GenreData $genreData
     *
     * @return Genre
     */
    public function create(GenreData $genreData): Genre
    {
        $genre = new Genre($genreData);
        $this->genreRepository->save($genre);

        return $genre;
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
        $genre->change($data);
        $this->genreRepository->save($genre);

        return $genre;
    }

    /**
     * Удаляет жанр
     *
     * @param Genre $genre
     */
    public function remove(Genre $genre): void
    {
        if ($this->genreRepository->isInUse($genre)) {
            return;
        }

        $this->genreRepository->remove($genre);
    }
}