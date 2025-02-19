<?php

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

/**
 * @param array $data
 * @param string $message
 * @param int $status
 * @param true $success
 * @return Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
 */
function apiResponse(array $data = [], string $message = '', int $status = 200, bool $success = true): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
{
    $response = [];

    !empty($data) && $response['data'] = $data;
    !empty($message) && $response['message'] = $message;

    return response($response, $status);
}
