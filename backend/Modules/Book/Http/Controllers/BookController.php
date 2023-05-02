<?php

namespace Modules\Book\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Book\Http\Requests\StoreBookRequest;
use Modules\Book\Http\Requests\UpdateBookRequest;
use Modules\Book\Repositories\Api\V1\BookRepository;
use Modules\Core\Http\Controllers\CoreController;

class BookController extends CoreController
{
    public $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $books = $this->repository->listBooks($request);

        return $this->responseJson(config('book.status_message.success'), Response::HTTP_OK, $books);
    }

    public function store(StoreBookRequest $request)
    {
        $params = $request->all();

        $book = $this->repository->createBook($params);

        if (!$book) {
            return $this->responseJson(config('book.status_message.error'), Response::HTTP_BAD_REQUEST, null);
        }

        return $this->responseJson(config('book.status_message.created'), Response::HTTP_CREATED, $book, "Book Saved.");
    }

    public function show($id)
    {
        $book = $this->repository->findBookById($id);

        if (!$book) {
            return $this->responseJson(config('book.status_message.error'), Response::HTTP_BAD_REQUEST, null);
        }

        return $this->responseJson(config('book.status_message.created'), Response::HTTP_OK, $book);
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $params = $request->all();

        $book = $this->repository->updateBook($params, $id);

        if (!$book) {
            return $this->responseJson(config('book.status_message.error'), Response::HTTP_BAD_REQUEST, null);
        }

        return $this->responseJson(config('book.status_message.created'), Response::HTTP_OK, $book, "Book Updated.");
    }

    public function destroy($id)
    {
        $this->repository->deleteBook($id);

        return $this->responseJson(config('book.status_message.deleted'), Response::HTTP_NO_CONTENT, null, "Book Deleted");
    }
}
