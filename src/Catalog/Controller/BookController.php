<?php

namespace App\Catalog\Controller;

use App\Catalog\Entity\Book;
use App\Catalog\Filter\BookHttpFilter;
use App\Catalog\Form\BookType;
use App\Catalog\Service\BookServiceInterface;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Контроллер управления книгами
 */
#[Route('/api/v1/books')]
class BookController
{
    /**
     * Конструктор
     *
     * @param BookServiceInterface $bookService
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        private readonly BookServiceInterface $bookService,
        private readonly FormFactoryInterface $formFactory,
    ) {
    }

    /**
     * Возвращает список книг
     *
     * @param Request $request
     *
     * @return Response
     */
    #[Route(name: 'book.list', methods: ['GET'])]
    public function getList(Request $request): Response
    {
        $filter = new BookHttpFilter($request);

        return new JsonResponse($this->bookService->getList($filter));
    }

    /**
     * Создает книгу
     *
     * @param Request $request
     *
     * @return Response
     */
    #[Route(name: 'book.create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $form = $this->formFactory->create(BaseType::class);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return new JsonResponse(null, 400);
        }

        $account = $this->bookService->create($form->getData());

        return new JsonResponse(null, 201);
    }

    /**
     * Изменяет книгу
     *
     * @param Book    $book
     * @param Request $request
     *
     * @return Response
     */
    #[Route(name: 'book.change', methods: ['PUT'])]
    public function change(Book $book, Request $request): Response
    {
        $form = $this->formFactory->create(BookType::class);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return new JsonResponse(null, 400);
        }

        $account = $this->bookService->change($book, $form->getData());

        return new JsonResponse(null);
    }

    /**
     * Удаляет книгу
     *
     * @param Book $book
     *
     * @return Response
     */
    #[Route(name: 'book.delete', methods: ['DELETE'])]
    public function delete(Book $book): Response
    {
        $this->bookService->remove($book);

        return new JsonResponse(null, 204);
    }
}