<?php

namespace PTK\Console\Form\Field;

/**
 *
 * Implementa funcionalidade de campo requerido
 * 
 */
trait RequiredTrait {
    /**
     * 
     * @var bool
     */
    protected bool $required = false;
    
    /**
     * Caracter indicador de campo requerido.
     * @var string|null
     */
    protected ?string $requiredIndicator = '*';
    
    /**
     * 
     * @param bool $required
     * @return FieldInterface
     * @inheritDoc
     */
    public function required(bool $required): FieldInterface {
        $this->required = $required;
        return $this;
    }
    
    /**
     * 
     * @return bool
     * @inheritDoc
     */
    public function isRequired(): bool {
        return $this->required;
    }
    
    /**
     * 
     * @param string|null $indicator
     * @return FieldInterface
     * @inheritDoc
     */
    public function setRequiredIndicator(?string $indicator): FieldInterface {
        $this->requiredIndicator = $indicator;
        return $this;
    }
}
