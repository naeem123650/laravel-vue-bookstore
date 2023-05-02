<?php

namespace Modules\Book\Repositories\Api\V1;

interface BookRepository
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBooks($request, string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findBookById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createBook(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBook(array $params, $id);

    /**
     * @param $id
     * @return bool
     */
    public function deleteBook($id);
}
