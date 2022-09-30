<?php

namespace App\Catalog\Form;

use App\Catalog\Entity\BookData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Форма книги
 */
class BookType extends AbstractType
{
    /**
     * Инициализирует форму
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['empty_data' => ''])
            ->add('issueDate', TextType::class, ['empty_data' => ''])
            ->add('rating', NumberType::class, ['empty_data' => ''])
            ->add('authors', CollectionType::class, ['entry_type' => AuthorType::class])
            ->add('genres', CollectionType::class, ['entry_type' => GenreType::class]);
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
            'data_class'         => BookData::class,
        ]);
    }
}