<?php

namespace App\Catalog\Entity;

use App\Catalog\Repository\GenreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Жанр
 */
#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    /**
     * Идентификатор
     *
     * @var string
     */
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 36)]
    private string $id;

    /**
     * Название
     *
     * @var string
     */
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    /**
     * Конструктор
     *
     * @param GenreData $data
     */
    public function __construct(GenreData $data)
    {
        $this->id   = Uuid::uuid4()->toString();
        $this->name = $data->getName();
    }

    /**
     * Возвращает идентификатор
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Возвращает название
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Изменяет данные жанра
     *
     * @param GenreData $data
     */
    public function change(GenreData $data): void
    {
        $this->name = $data->getName();
    }
}
