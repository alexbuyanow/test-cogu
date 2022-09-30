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
     * Устанавливает имя
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     * Устанавливает дату рождения
     *
     * @param DateTimeInterface $birthDate
     */
    public function setBirthDate(DateTimeInterface $birthDate): void
    {
        $this->birthDate = $birthDate;
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
     * Устанавливает пол
     *
     * @param string|null $gender
     */
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }
}