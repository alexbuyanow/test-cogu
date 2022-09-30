<?php

namespace App\Catalog\Service;

use App\Catalog\Entity\Author;
use App\Catalog\Entity\AuthorData;
use App\Catalog\Filter\AuthorFilterInterface;

class AuthorService implements AuthorServiceInterface
{
    /**
     * Возвращает список авторов
     *
     * @param AuthorFilterInterface $filter
     *
     * @return Author[]
     */
    public function getList(AuthorFilterInterface $filter): array
    {
        return [];
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
        return new Author(new AuthorData('', new \DateTime(), ''));
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
        return new Author(new AuthorData('', new \DateTime(), ''));
    }

    /**
     * Удаляет автора
     *
     * @param Author $author
     */
    public function remove(Author $author): void
    {

    }
}