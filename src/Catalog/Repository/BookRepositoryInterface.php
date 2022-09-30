<?php

namespace App\Catalog\Repository;

use App\Catalog\Entity\Book;
use App\Catalog\Filter\BookFilterInterface;

/**
 * Интерфейс репозитория книг
 */
interface BookRepositoryInterface
{
    /**
     * Возвращает список книг
     *
     * @param BookFilterInterface $filter
     *
     * @return Book[]
     */
    public function getList(BookFilterInterface $filter): array;

    /**
     * Сохраняет книгу
     *
     * @param Book $book
     */
    public function save(Book $book);

    /**
     * Удаляет книгу
     *
     * @param Book $book
     */
    public function remove(Book $book): void;
}