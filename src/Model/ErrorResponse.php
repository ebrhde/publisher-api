<?php

namespace App\Model;

class ErrorResponse
{
    private string $message;
    private $details;

    public function __construct(string $message, $details = null)
    {
        $this->message = $message;
        $this->details = $details;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
