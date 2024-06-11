<?php


namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class BadRequestException extends Exception
{
    protected $message;

    public function __construct($message = 'Bad Request')
    {
        $this->message = $message;
        parent::__construct($message, Response::HTTP_BAD_REQUEST);
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'Bad Request',
            'message' => $this->getMessage(),
        ], Response::HTTP_BAD_REQUEST);
    }
}
