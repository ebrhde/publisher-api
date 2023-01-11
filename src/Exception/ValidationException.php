<?php

namespace App\Exception;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends \RuntimeException
{
    private ConstraintViolationListInterface $violations;

    public function __construct(ConstraintViolationListInterface $violations)
    {
        parent::__construct('validation failed');
        $this->violations = $violations;
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
