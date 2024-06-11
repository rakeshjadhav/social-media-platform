<?php


namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InternalServerErrorException extends Exception
{
    protected $message;

    public function __construct($message = 'Internal Server Error')
    {
        $this->message = $message;
        parent::__construct($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'Internal Server Error',
            'message' => $this->getMessage(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
