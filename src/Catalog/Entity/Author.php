<?php

namespace App\Catalog\Entity;

use App\Catalog\Repository\AuthorRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Жанр
 */
#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
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
     * Имя
     *
     * @var string
     */
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    /**
     * Дата рождения
     *
     * @var DateTimeInterface
     */
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private DateTimeInterface $birthDate;

    /**
     * Пол
     *
     * @var string|null
     */
    #[ORM\Column(type: Types::STRING, length: 10)]
    private ?string $gender;

    /**
     * Конструктор
     *
     * @param AuthorData $data
     */
    public function __construct(AuthorData $data)
    {
        $this->id        = Uuid::uuid4()->toString();
        $this->name      = $data->getName();
        $this->birthDate = $data->getBirthDate();
        $this->gender    = $data->getGender();
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
     * Возвращает имя
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Возвращает дату рождения
     *
     * @return DateTimeInterface
     */
    public function getBirthDate(): DateTimeInterface
    {
        return $this->birthDate;
    }

    /**
     * Возвращает пол
     *
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * Изменяет данные автора
     *
     * @param AuthorData $data
     */
    public function change(AuthorData $data): void
    {
        $this->name      = $data->getName();
        $this->birthDate = $data->getBirthDate();
        $this->gender    = $data->getGender();
    }
}