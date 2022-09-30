<?php

namespace App\Catalog\Repository;

use App\Catalog\Entity\Book;
use App\Catalog\Filter\BookFilterInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий книг
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository implements BookRepositoryInterface
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
        $builder = $this->createQueryBuilder('b');

        $this->applyFilter($builder, $filter);
        $this->applyLimits($builder, $filter);

        return $builder->getQuery()->getResult();
    }

    /**
     * Сохраняет книгу
     *
     * @param Book $book
     */
    public function save(Book $book)
    {
        $this->_em->persist($book);
        $this->_em->flush();
    }

    /**
     * Удаляет книгу
     *
     * @param Book $book
     */
    public function remove(Book $book): void
    {
        $this->_em->remove($book);
        $this->_em->flush();
    }

    /**
     * Применяет фильтр списков
     *
     * @param QueryBuilder        $builder
     * @param BookFilterInterface $filter
     */
    private function applyFilter(QueryBuilder $builder, BookFilterInterface $filter): void
    {
        if ($name = $filter->getName()) {
            $builder->andWhere($builder->expr()->eq('b.name', ':name'))
                ->setParameter('name', $name);
        }

        if ($author = $filter->getAuthor()) {
            $builder->andWhere($builder->expr()->eq('b.author.id', ':author'))
                ->setParameter('author', $author);
        }

        if ($genre = $filter->getGenre()) {
            $builder->andWhere($builder->expr()->eq('b.genre.id', ':genre'))
                ->setParameter('genre', $genre);
        }
    }

    /**
     * Применяет фильтр списков
     *
     * @param QueryBuilder        $builder
     * @param BookFilterInterface $filter
     */
    private function applyLimits(QueryBuilder $builder, BookFilterInterface $filter): void
    {
        if ($limit = $filter->getLimit()) {
            $builder->setMaxResults($limit);
        }

        if ($offset = $filter->getOffset()) {
            $builder->setFirstResult($offset);
        }
    }
}