<?php

namespace App\Catalog\Entity;

use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Данные книги
 */
class BookData
{
    /**
     * Конструтор
     *
     * @param string            $name
     * @param DateTimeInterface $issueDate
     * @param float             $rating
     * @param array             $authors
     * @param array             $genres
     */
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(max: 255)]
        private string $name,
        #[Assert\NotBlank]
        #[Assert\DateTime]
        private DateTimeInterface $issueDate,
        #[Assert\NotBlank]
        #[Assert\PositiveOrZero]
        #[Assert\LessThanOrEqual(10)]
        private float $rating,
        #[Assert\Collection]
        private array $authors,
        #[Assert\Collection]
        private array $genres,
    ) {
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
     * Возвращает дату выпуска
     *
     * @return DateTimeInterface
     */
    public function getIssueDate(): DateTimeInterface
    {
        return $this->issueDate;
    }

    /**
     * Устанавливает дату выпуска
     *
     * @param DateTimeInterface $issueDate
     */
    public function setIssueDate(DateTimeInterface $issueDate): void
    {
        $this->issueDate = $issueDate;
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
     * Устанавливает рейтинг
     *
     * @param float $rating
     */
    public function setRating(float $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * Возвращает список авторов
     *
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * Устанавливает список авторов
     *
     * @param array $authors
     */
    public function setAuthors(array $authors): void
    {
        $this->authors = $authors;
    }

    /**
     * Возвращает список жанров
     *
     * @return array
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * Устанавливает список жанров
     *
     * @param array $genres
     */
    public function setGenres(array $genres): void
    {
        $this->genres = $genres;
    }
}