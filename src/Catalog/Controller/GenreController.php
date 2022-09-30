<?php

namespace App\Catalog\Controller;

use App\Catalog\Entity\Genre;
use App\Catalog\Filter\GenreHttpFilter;
use App\Catalog\Form\GenreType;
use App\Catalog\Service\GenreServiceInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/genres')]
/**
 * Контроллер управления жанрами
 */
class GenreController
{
    /**
     * Конструктор
     *
     * @param GenreServiceInterface $genreService
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        private readonly GenreServiceInterface $genreService,
        private readonly FormFactoryInterface $formFactory,
    ) {
    }

    /**
     * Возвращает список жанров
     *
     * @param Request $request
     *
     * @return Response
     */
    #[Route(name: 'genre.list', methods: ['GET'])]
    public function getList(Request $request): Response
    {
        $filter = new GenreHttpFilter($request);

        return new JsonResponse($this->genreService->getList($filter));
    }

    /**
     * Создает жанр
     *
     * @param Request $request
     *
     * @return Response
     */
    #[Route(name: 'genre.create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $form = $this->formFactory->create(GenreType::class);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return new JsonResponse(null, 400);
        }

        $genre = $this->genreService->create($form->getData());

        return new JsonResponse(null, 201);
    }

    /**
     * Изменяет жанр
     *
     * @param Genre   $genre
     * @param Request $request
     *
     * @return Response
     */
    #[Route(name: 'genre.change', methods: ['PUT'])]
    public function change(Genre $genre, Request $request): Response
    {
        $form = $this->formFactory->create(GenreType::class);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return new JsonResponse(null, 400);
        }

        $genre = $this->genreService->change($genre, $form->getData());

        return new JsonResponse(null);
    }

    /**
     * Удаляет жанр
     *
     * @param Genre $genre
     *
     * @return Response
     */
    #[Route(name: 'genre.delete', methods: ['DELETE'])]
    public function delete(Genre $genre): Response
    {
        $this->genreService->remove($genre);

        return new JsonResponse(null, 204);
    }
}