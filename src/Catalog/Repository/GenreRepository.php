<?php

namespace App\Catalog\Repository;

use App\Catalog\Entity\Genre;
use App\Catalog\Filter\GenreFilterInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
        return [];
    }

    /**
     * Сохраняет жанр
     *
     * @param Genre $genre
     */
    public function save(Genre $genre): void
    {

    }

    /**
     * Удаляет жанр
     *
     * @param Genre $genre
     */
    public function remove(Genre $genre): void
    {

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
        return true;
    }
}