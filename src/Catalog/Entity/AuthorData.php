<?php

namespace App\Catalog\Entity;

use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Данные автора
 */
class AuthorData
{
    public const GENDER_MALE = 'm';
    public const GENDER_FEMALE = 'f';
    public const GENDER_UNDEFINED = '';

    /**
     * Конструктор
     *
     * @param string            $name
     * @param DateTimeInterface $birthDate
     * @param string            $gender
     */
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(max: 255)]
        private string $name,
        #[Assert\NotBlank]
        private DateTimeInterface $birthDate,
        #[Assert\Choice(callback: 'getSexTypesList')]
        private string $gender,
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
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * Устанавливает пол
     *
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * Возвращает варианты пола
     *
     * @return string[]
     */
    public function getSexTypesList(): array
    {
        return [
            static::GENDER_MALE,
            static::GENDER_FEMALE,
            static::GENDER_UNDEFINED,
        ];
    }
}