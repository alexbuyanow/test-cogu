<?php

namespace App\Catalog\Repository;

use App\Catalog\Entity\Author;
use App\Catalog\Entity\Genre;
use App\Catalog\Filter\AuthorFilterInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
        return [];
    }

    /**
     * Сохраняет автора
     *
     * @param Author $author
     */
    public function save(Author $author): void
    {

    }

    /**
     * Удаляет автора
     *
     * @param Author $author
     */
    public function remove(Author $author): void
    {

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
        return true;
    }
}