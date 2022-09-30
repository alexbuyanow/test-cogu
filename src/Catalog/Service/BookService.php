<?php

namespace App\Catalog\Service;

use App\Catalog\Entity\Book;
use App\Catalog\Entity\BookData;
use App\Catalog\Filter\BookFilterInterface;

class BookService implements BookServiceInterface
{
    /**
     * Возвращает список книг
     *
     * @param BookFilterInterface $filter
     *
     * @return Book[]
     */
    public function getList(BookFilterInterface $filter): array
    {
        return [];
    }

    /**
     * Создает книгу
     *
     * @param BookData $book
     *
     * @return Book
     */
    public function create(BookData $book): Book
    {
        return new Book(new BookData('', new \DateTime(), 0, [], []));
    }

    /**
     * Изменяет книгу
     *
     * @param Book     $book
     * @param BookData $data
     *
     * @return Book
     */
    public function change(Book $book, BookData $data): Book
    {
        return new Book(new BookData('', new \DateTime(), 0, [], []));
    }

    /**
     * Удаляет книгу
     *
     * @param Book $book
     */
    public function remove(Book $book): void
    {

    }
}