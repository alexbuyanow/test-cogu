<?php

namespace App\Catalog\Form;

use App\Catalog\Entity\GenreData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Форма жанра
 */
class GenreType extends AbstractType
{
    /**
     * Инициализирует форму
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, ['empty_data' => '']);
    }

    /**
     * Устанавливает параметры формы
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'allow_extra_fields' => true,
            'csrf_protection'    => false,
            'error_bubbling'     => false,
            'data_class'         => GenreData::class,
        ]);
    }
}