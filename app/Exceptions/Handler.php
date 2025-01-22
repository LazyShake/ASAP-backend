<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // Обработка ModelNotFoundException
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Ресурс не найден',
            ], Response::HTTP_NOT_FOUND);
        }

        // Обработка ValidationException
        if ($exception instanceof ValidationException) {
            return response()->json([
                'error' => 'Некорректные данные',
                'details' => $exception->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Для всех остальных ошибок
        return response()->json([
            'error' => 'Произошла ошибка на сервере',
            'message' => $exception->getMessage(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
