<?php

namespace PTK\Console\Form\Exception;

use Exception;
use Throwable;

/**
 * Quando uma funcionalidade não é suportada
 *
 * @author Everton
 */
class FeatureNotSupportedException extends Exception {
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
