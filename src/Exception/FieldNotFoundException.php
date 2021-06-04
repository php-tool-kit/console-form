<?php

namespace PTK\Console\Form\Exception;

use Exception;
use Throwable;

/**
 * Exceção lançada quando um determinado campo não existe no formulário
 *
 * @author Everton
 */
class FieldNotFoundException extends Exception {
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
