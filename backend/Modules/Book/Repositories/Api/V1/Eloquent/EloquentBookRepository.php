<?php

namespace Modules\Book\Repositories\Api\V1\Eloquent;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Http\UploadedFile;
use Modules\Book\Traits\Uploadable;
use Modules\Book\Entities\Book;
use Modules\Book\Repositories\Api\V1\BookRepository;
use Modules\Book\Transformers\BookResource;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentBookRepository extends EloquentBaseRepository implements BookRepository
{
    use Uploadable;

    protected $model;
    /**
     * ProductRepository constructor.
     * @param Book $model
     */
    public function __construct(Book $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBooks($request, string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        try {
            return  $this->model->search($request->search)
                ->query(fn ($query) => $query->limit($request->get('page') ?? 1))
                ->paginate(9);
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }


    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findBookById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Book|mixed
     */
    public function createBook(array $params)
    {
        try {

            $collection = collect($params);

            $image = null;

            if ($collection->has('image') && ($params['image'] instanceof UploadedFile)) {
                $image =  $this->uploadOne($params['image'], 'books');
            }

            $published =  $collection->has('published') && $params['published'] == true ? Carbon::now() : null;

            $mergeCollection = $collection->merge(compact("image", "published"));

            $book = new Book($mergeCollection->all());

            $book->save();

            return $book;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBook(array $params, $id)
    {
        try {

            $book = $this->findBookById($id);

            $collection = collect($params)->except('_token');

            $image = getParseUrl($book->image);

            if ($collection->has('image') && ($params['image'] instanceof UploadedFile)) {
                if ($book->image != null) {
                    $parsedUrl = getParseUrl($book->image);
                    $this->deleteOne($parsedUrl);
                }
                $image = $this->uploadOne($params['image'], "books");
            }

            $published =  $collection->has('published') && $params['published'] == true ? Carbon::now() : null;

            $mergeCollection = $collection->merge(compact('image', 'published'));

            $book->update($mergeCollection->all());

            return $book;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteBook($id)
    {
        try {
            $book = $this->findBookById($id);

            if ($book->image != null) {
                $parsedUrl = getParseUrl($book->image);
                $this->deleteOne($parsedUrl);
            }

            $book->delete();

            return $book;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
}
