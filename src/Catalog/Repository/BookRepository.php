<?php

namespace App\Catalog\Repository;

use App\Catalog\Entity\Book;
use App\Catalog\Filter\BookFilterInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий книг
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    /**
     * Конструктор
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
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
        return [];
    }

    /**
     * Сохраняет книгу
     *
     * @param Book $book
     */
    public function save(Book $book)
    {

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