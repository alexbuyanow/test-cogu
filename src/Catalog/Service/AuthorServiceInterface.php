<?php

namespace App\Catalog\Service;

use App\Catalog\Entity\Author;
use App\Catalog\Entity\AuthorData;
use App\Catalog\Filter\AuthorFilterInterface;

/**
 * Интерфейс сервиса авторов
 */
interface AuthorServiceInterface
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
     * Создает автора
     *
     * @param AuthorData $data
     *
     * @return Author
     */
    public function create(AuthorData $data): Author;

    /**
     * Изменяет автора
     *
     * @param Author     $author
     * @param AuthorData $data
     *
     * @return Author
     */
    public function change(Author $author, AuthorData $data): Author;

    /**
     * Удаляет автора
     *
     * @param Author $author
     */
    public function remove(Author $author): void;
}