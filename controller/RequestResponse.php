<?php


abstract class RequestResponse
{

    /**
     * @return array
     */
    protected final function unprocessableEntityResponse(): array
    {
        $response['status_code'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    /**
     * @param $responseBody
     * @return array
     */
    protected final function notFoundResponse($responseBody): array
    {
        $response['status_code'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = $responseBody;
        return $response;
    }
}