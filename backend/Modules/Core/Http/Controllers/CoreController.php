<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CoreController extends Controller
{

    protected $data = [];

    /**
     * @param bool $error
     * @param int $responseCode
     * @param array $message
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson($status, $code = Response::HTTP_OK, $data = null, $message = "")
    {
        if ($status == config('book.status_message.success')) {
            return response()->json([
                'status' => $status,
                'code' => $code,
                'total' => $data->count(),
                'data' => $data,
            ], $code);
        } else if ($status == config('book.status_message.error')) {
            return response()->json([
                'status' => $status,
                'code' => $code,
                'data' => $data,
            ], $code);
        } else if ($status == config('book.status_message.created') || $status == config('book.status_message.deleted')) {
            return response()->json([
                'status' => config('book.status_message.success'),
                'code' => $code,
                'data' => $data,
                'message' => $message
            ], $code);
        }
    }
}
