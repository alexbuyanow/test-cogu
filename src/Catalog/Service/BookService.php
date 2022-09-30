<?php

namespace App\Catalog\Service;

use App\Catalog\Entity\Book;
use App\Catalog\Entity\BookData;
use App\Catalog\Filter\BookFilterInterface;
use App\Catalog\Repository\BookRepositoryInterface;

/**
 * Сервис книг
 */
class BookService implements BookServiceInterface
{
    /**
     * Конструктор
     *
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(private readonly BookRepositoryInterface $bookRepository)
    {
    }

    /**
     * Возвращает список книг
     *
     * @param BookFilterInterface $filter
     *
     * @return Book[]
     */
    public function getList(BookFilterInterface $filter): array
    {
        return $this->bookRepository->getList($filter);
    }

    /**
     * Создает книгу
     *
     * @param BookData $data
     *
     * @return Book
     */
    public function create(BookData $data): Book
    {
        $book = new Book($data);
        $this->bookRepository->save($book);

        return $book;
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
        $book->change($data);
        $this->bookRepository->save($book);

        return $book;
    }

    /**
     * Удаляет книгу
     *
     * @param Book $book
     */
    public function remove(Book $book): void
    {
        $this->bookRepository->remove($book);
    }
}