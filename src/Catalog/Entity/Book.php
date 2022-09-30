<?php

namespace App\Catalog\Entity;

use App\Catalog\Repository\BookRepository;
use Carbon\Carbon;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Книга
 */
#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
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
     * Дата выпуска
     *
     * @var DateTimeInterface
     */
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private DateTimeInterface $issueDate;

    /**
     * Дата помещения в каталог
     *
     * @var DateTimeInterface
     */
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private DateTimeInterface $createDate;

    /**
     * Рейтинг
     *
     * @var float
     */
    #[ORM\Column(type: Types::FLOAT)]
    private float $rating;

    /**
     * Авторы книги
     *
     * @var Collection
     */
    #[ORM\ManyToMany(targetEntity: Author::class)]
    #[ORM\JoinTable(name: 'book_author')]
    #[ORM\JoinColumn(name: 'book_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'author_id', referencedColumnName: 'id')]
    private Collection $authors;

    /**
     * Жанры книги
     *
     * @var Collection
     */
    #[ORM\ManyToMany(targetEntity: Genre::class)]
    #[ORM\JoinTable(name: 'book_genre')]
    #[ORM\JoinColumn(name: 'book_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'genre_id', referencedColumnName: 'id')]
    private Collection $genres;

    /**
     * Конструктор
     *
     * @param BookData $data
     */
    public function __construct(BookData $data)
    {
        $this->id         = Uuid::uuid4()->toString();
        $this->name       = $data->getName();
        $this->issueDate  = $data->getIssueDate();
        $this->createDate = Carbon::now();
        $this->rating     = $data->getRating();
        $this->authors    = new ArrayCollection($data->getAuthors());
        $this->genres     = new ArrayCollection($data->getGenres());
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
     * Возвращает дату выпуска
     *
     * @return DateTimeInterface
     */
    public function getIssueDate(): DateTimeInterface
    {
        return $this->issueDate;
    }

    /**
     * Возвращает дату помещения в каталог
     *
     * @return DateTimeInterface
     */
    public function getCreateDate(): DateTimeInterface
    {
        return $this->createDate;
    }

    /**
     * Возвращает рейтинг
     *
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }

    /**
     * Возвращает авторов
     *
     * @return Author[]
     */
    public function getAuthors(): array
    {
        return $this->authors->toArray();
    }

    /**
     * Возвращает жанры
     *
     * @return Genre[]
     */
    public function getGenres(): array
    {
        return $this->genres->toArray();
    }

    /**
     * Изменяет данные книги
     *
     * @param BookData $data
     */
    public function change(BookData $data): void
    {
        $this->name      = $data->getName();
        $this->issueDate = $data->getIssueDate();
        $this->rating    = $data->getRating();

        $this->changeAuthors($data->getAuthors());
        $this->changeGenres($data->getGenres());
    }

    /**
     * Изменяет список авторов
     *
     * @param array $authors
     */
    private function changeAuthors(array $authors): void
    {
        $this->authors->clear();

        foreach ($authors as $current) {
            $this->authors->add($current);
        }
    }

    /**
     * Изменяет список жанров
     *
     * @param array $genres
     */
    private function changeGenres(array $genres): void
    {
        $this->genres->clear();

        foreach ($genres as $current) {
            $this->genres->add($current);
        }
    }
}