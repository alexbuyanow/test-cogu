<?php

namespace App\Catalog\Controller;

use App\Catalog\Entity\Author;
use App\Catalog\Filter\AuthorHttpFilter;
use App\Catalog\Form\AuthorType;
use App\Catalog\Service\AuthorServiceInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/authors')]
/**
 * Контроллер управления авторами
 */
class AuthorController
{
    /**
     * Конструктор
     *
     * @param AuthorServiceInterface $authorService
     * @param FormFactoryInterface   $formFactory
     */
    public function __construct(
        private readonly AuthorServiceInterface $authorService,
        private readonly FormFactoryInterface  $formFactory,
    ) {
    }

    /**
     * Возвращает список авторов
     *
     * @param Request $request
     *
     * @return Response
     */
    #[Route(name: 'author.list', methods: ['GET'])]
    public function getList(Request $request): Response
    {
        $filter = new AuthorHttpFilter($request);

        return new JsonResponse($this->authorService->getList($filter));
    }

    /**
     * Создает автора
     *
     * @param Request $request
     *
     * @return Response
     */
    #[Route(name: 'author.create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $form = $this->formFactory->create(AuthorType::class);
        $form->submit($request->toArray());

        if (!$form->isValid()) {
            return new JsonResponse(null, 400);
        }

        $author = $this->authorService->create($form->getData());

        return new JsonResponse(null, 201);
    }

    /**
     * Изменяет автора
     *
     * @param Author  $author
     * @param Request $request
     *
     * @return Response
     */
    #[Route(name: 'author.change', methods: ['PUT'])]
    public function change(Author $author, Request $request): Response
    {
        $form = $this->formFactory->create(AuthorType::class);
        $form->submit($request->toArray());

        if (!$form->isValid()) {
            return new JsonResponse(null, 400);
        }

        $author = $this->authorService->change($author, $form->getData());

        return new JsonResponse(null);
    }

    /**
     * Удаляет автора
     *
     * @param Author $author
     *
     * @return Response
     */
    #[Route(name: 'author.delete', methods: ['DELETE'])]
    public function delete(Author $author): Response
    {
        $this->authorService->remove($author);

        return new JsonResponse(null, 204);
    }
}