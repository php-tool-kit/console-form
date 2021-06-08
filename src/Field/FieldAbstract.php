<?php

namespace PTK\Console\Form\Field;

use League\CLImate\CLImate;

/**
 * Classe auxiliar para campos.
 *
 * @author Everton
 */
abstract class FieldAbstract implements FieldInterface {
    
    /**
     * 
     * @var CLImate
     */
    protected CLImate $climate;
    
    /**
     * 
     * @var mixed Armazena o valor do campo.
     */
    protected $answer;
    
    /**
     * 
     * @var string Rótulo do campo.
     */
    protected string $label;
    
    /**
     * 
     * @var string|int Id do campo.
     */
    protected string|int $id;
    
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
     * @param string|int $id
     * @param string $label
     * @inheritDoc
     */
    public function __construct(string|int $id, string $label) {
        $this->climate = new CLImate();
        $this->id = $id;
        $this->label = $label;
    }

    /**
     * 
     * @return mixed
     * @inheritDoc
     */
    public function answer() {
        return $this->answer;
    }
    
    /**
     * 
     * @return string|int
     * @inheritDoc
     */
    public function id(): string|int {
        return $this->id;
    }
    
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
    
    /**
     * @inheritDoc
     */
    abstract public function ask(): void;

}
