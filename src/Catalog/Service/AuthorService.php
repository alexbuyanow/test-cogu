<?php

namespace App\Catalog\Service;

use App\Catalog\Entity\Author;
use App\Catalog\Entity\AuthorData;
use App\Catalog\Filter\AuthorFilterInterface;
use App\Catalog\Repository\AuthorRepositoryInterface;

/**
 * Сервис авторов
 */
class AuthorService implements AuthorServiceInterface
{
    /**
     * Конструктор
     *
     * @param AuthorRepositoryInterface $authorRepository
     */
    public function __construct(private readonly AuthorRepositoryInterface $authorRepository)
    {
    }

    /**
     * Возвращает список авторов
     *
     * @param AuthorFilterInterface $filter
     *
     * @return Author[]
     */
    public function getList(AuthorFilterInterface $filter): array
    {
        return $this->authorRepository->getList($filter);
    }

    /**
     * Создает автора
     *
     * @param AuthorData $data
     *
     * @return Author
     */
    public function create(AuthorData $data): Author
    {
        $author = new Author($data);
        $this->authorRepository->save($author);

        return $author;
    }

    /**
     * Изменяет автора
     *
     * @param Author     $author
     * @param AuthorData $data
     *
     * @return Author
     */
    public function change(Author $author, AuthorData $data): Author
    {
        $author->change($data);
        $this->authorRepository->save($author);

        return $author;
    }

    /**
     * Удаляет автора
     *
     * @param Author $author
     */
    public function remove(Author $author): void
    {
        if ($this->authorRepository->isInUse($author)) {
            return;
        }

        $this->authorRepository->remove($author);
    }
}