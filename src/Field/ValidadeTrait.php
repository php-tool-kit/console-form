<?php

namespace PTK\Console\Form\Field;

/**
 *
 * Trait para campos com validação.
 */
trait ValidadeTrait {

    /**
     * 
     * @var callable|null Validador do campo.
     */
    protected $validator = null;

    /**
     * 
     * @var string Mensagem caso a validação falhe.
     */
    protected string $validatorMessage = '';

    /**
     * 
     * @param callable $validator
     * @param string $message
     * @return FieldInterface
     * @inheritDoc
     */
    public function setValidator(callable $validator, string $message): FieldInterface {
        $this->required = true;
        $this->validator = $validator;
        $this->validatorMessage = $message;
        return $this;
    }

    protected function validate(): bool {
        if ($this->validator !== null) {
            $validator = $this->validator;
            return $validator($this->answer);
        }
        return true;
    }

}
