<?php

namespace App\Catalog\Repository;

use App\Catalog\Entity\Author;
use App\Catalog\Entity\Book;
use App\Catalog\Entity\Genre;
use App\Catalog\Filter\AuthorFilterInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий авторов
 *
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository implements AuthorRepositoryInterface
{
    /**
     * Конструктор
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genre::class);
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
        $builder = $this->createQueryBuilder('a');

        $this->applyFilter($builder, $filter);

        return $builder->getQuery()->getResult();
    }

    /**
     * Сохраняет автора
     *
     * @param Author $author
     */
    public function save(Author $author): void
    {
        $this->_em->persist($author);
        $this->_em->flush();
    }

    /**
     * Удаляет автора
     *
     * @param Author $author
     */
    public function remove(Author $author): void
    {
        $this->_em->remove($author);
        $this->_em->flush();
    }

    /**
     * Используется ли автор
     *
     * @param Author $author
     *
     * @return bool
     */
    public function isInUse(Author $author): bool
    {
        $builder = $this->_em->createQueryBuilder()
            ->select()
            ->from(Book::class, 'b');
        $builder->where($builder->expr()->eq('b.author', ':author'))
            ->setParameter('author', $author);

        return (bool) $builder->getQuery()->getFirstResult();
    }

    /**
     * Применяет фильтр списков
     *
     * @param QueryBuilder          $builder
     * @param AuthorFilterInterface $filter
     */
    private function applyFilter(QueryBuilder $builder, AuthorFilterInterface $filter): void
    {
        if ($name = $filter->getName()) {
            $builder->andWhere($builder->expr()->eq('a.name', ':name'))
                ->setParameter('name', $name);
        }
    }
}