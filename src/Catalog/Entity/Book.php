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
}