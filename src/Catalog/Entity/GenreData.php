<?php

namespace App\Catalog\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Данные жанра
 */
class GenreData
{
    /**
     * Конструктор
     *
     * @param string $name
     */
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(max: 255)]
        private string $name,
    ) {
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
     * Устанавливает название
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}