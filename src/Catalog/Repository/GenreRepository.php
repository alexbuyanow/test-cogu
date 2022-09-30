<?php

namespace App\Catalog\Repository;

use App\Catalog\Entity\Book;
use App\Catalog\Entity\Genre;
use App\Catalog\Filter\GenreFilterInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий жанров
 *
 * @method Genre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genre[]    findAll()
 * @method Genre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenreRepository extends ServiceEntityRepository implements GenreRepositoryInterface
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
     * Возвращает список жанров
     *
     * @param GenreFilterInterface $filter
     *
     * @return Genre[]
     */
    public function getList(GenreFilterInterface $filter): array
    {
        $builder = $this->createQueryBuilder('g');

        $this->applyFilter($builder, $filter);

        return $builder->getQuery()->getResult();
    }

    /**
     * Сохраняет жанр
     *
     * @param Genre $genre
     */
    public function save(Genre $genre): void
    {
        $this->_em->persist($genre);
        $this->_em->flush();
    }

    /**
     * Удаляет жанр
     *
     * @param Genre $genre
     */
    public function remove(Genre $genre): void
    {
        $this->_em->remove($genre);
        $this->_em->flush();
    }

    /**
     * Используется ли жанр
     *
     * @param Genre $genre
     *
     * @return bool
     */
    public function isInUse(Genre $genre): bool
    {
        $builder = $this->_em->createQueryBuilder()
            ->select()
            ->from(Book::class, 'b');
        $builder->where($builder->expr()->eq('b.genre', ':genre'))
            ->setParameter('genre', $genre);

        return (bool) $builder->getQuery()->getFirstResult();
    }

    /**
     * Применяет фильтр списков
     *
     * @param QueryBuilder         $builder
     * @param GenreFilterInterface $filter
     */
    private function applyFilter(QueryBuilder $builder, GenreFilterInterface $filter): void
    {
        if ($name = $filter->getName()) {
            $builder->andWhere($builder->expr()->eq('g.name', ':name'))
                ->setParameter('name', $name);
        }
    }
}